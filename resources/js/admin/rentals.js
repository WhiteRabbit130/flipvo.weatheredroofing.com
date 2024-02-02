import $ from 'jquery';

// todo - init rentals table
// import {initUsersTable} from "../utils.js";
// let $table = $('#users-table');
// initUsersTable('admins', $table);

let user = null;
let mongoUser = null;

const $save = $('.save');
const $imagesHelp = $('#images-help');
const itemOptions = {
    active: true, images: [], paymentOptions: {}
};
const uploadedImages = [];
const $imageTemplate = $('#image-template');
const xCircle = '<i class="fas fa-times-circle float-right hover:text-red-600"></i>';
const $rentalForm = $('#rental-form');

$rentalForm.submit(function (e) {
    e.preventDefault();
    console.log('Submit clicked...');
});

const $imagesInput = $('#images');
$imagesInput.on('change', function (e) {
    let buffer = [];
    const uploadBuffer = [];
    const max = 6 - uploadedImages.length;
    // todo - could save as draft at this point...
    disableSave();
    $imagesHelp
        .html(`<i class="fas fa-file-image"></i> ${this.files.length} file${this.files.length > 1 ? 's' : ''} selected`); // Set files selected
    Array.prototype.push.apply(buffer, this.files); // Merge the file list to an array
    buffer = buffer.slice(0, max); // remove extra files

    console.log('buffer', buffer)
    console.log('uploadedImages', uploadedImages)

    // Check max
    if (uploadedImages.length === 6) { // max images
        new Noty({
            type: 'warning',
            text: `${xCircle}<i class="fas fa-exclamation-triangle"></i> 6 Images Max. Delete one first.`
        }).show();
        $imagesHelp.html(`<i class="fas fa-exclamation-triangle"></i> Max Files`);
        // enableSave();
        return false;
    }

    // Validate, check size, skip already uploaded, show image
    buffer.forEach(function (file) {
        if (file.size > 9555333) { // Skip BIG files, check max size - 9555333
            new Noty({
                type: 'warning',
                text: `${xCircle}<i class="fas fa-exclamation-triangle"></i> Skipping (File too BIG): ${file.name}`
            }).show();
            return;
        }
        if (uploadedImages.find(i => i.name === file.name)) { // Skip already uploaded
            new Noty({
                type: 'success',
                text: `${xCircle}<i class="fas fa-forward"></i> Skipping (Already uploaded): ${truncateString(file.name, 20)}`
            }).show();
            return;
        }
        uploadBuffer.push(showImage(file));
    });
    // Upload all images
    uploadImages(uploadBuffer);
});

function showImage(file) {
    let reader = new FileReader();
    let $clone = $imageTemplate.clone(true);
    console.log('file', file)
    console.log($clone)
    $clone.attr('id', '').removeClass('hidden').data('name', file.name); // set file name, for primary
    reader.readAsDataURL(file);
    reader.onload = function (e) { // Show preview image
        $clone.find('img').attr('src', e.target.result);
        $clone.appendTo('.image-container');

        // todo - set the primary stuff...
        // add primary to first
        // if (index === 0 && !$('.img-preview').hasClass('active')) {
        //     $pre.addClass('active');
        //     $pre.append($('<p class="text-center primary-img">' +
        //         '<small><i class="fa fa-check-circle"></i> Primary</small></p>'));
        // }
    };

    // set Delete click
    $clone.on('click', '.delete', function () {
        console.log('Delete clicked...')
        if (!file.tempFilePath) return;

        // Send to server
        axios.delete(`/api/sell/image/${file.tempFilePath}`)
            .then((result) => {
                if (result.data.result) {
                    // zoom out and remove element
                    $clone
                        .addClass('animate__animated animate__zoomOutLeft');
                    setTimeout($clone.remove.bind($clone), 999)
                    // Remove from uploadedImages
                    uploadedImages.splice(uploadedImages.findIndex(v => v.name === file.name), 1);
                    // Show Notifications
                    new Noty({
                        type: 'success',
                        text: `${xCircle}<i class="fas fa-check-circle animate__animated animate__heartBeat"></i> Deleted Image`
                    }).show();
                    $imagesHelp.html(`Image deleted <i class="fas fa-check-circle text-green-500 animate__animated animate__heartBeat"></i>`);
                }
            })
            .catch((e) => {
                console.log(e)
                // // Show message
                new Noty({
                    type: 'error', text: `${xCircle}<i class="fas fa-exclamation-triangle"></i> Error deleting image`
                }).show();

                // // Show errors
                // for (const p in errors) {
                //     if (errors.hasOwnProperty(p)) {
                //         errors[p].forEach(i => {
                //             new Noty({
                //                 type: 'warning',
                //                 text: `${xCircle}<i class="fas fa-exclamation-circle"></i> ${i}`
                //             }).show();
                //         })
                //     }
                // }
            });
    });

    file.$clone = $clone; // save clone
    return file;
}

function uploadImages(buffer) {
    const url = '/api/rentals/tmp/upload';
    // todo - could save as draft at this point...
    let awaitPromises = [];
    if (!buffer.length) { // Nothing to upload, enable Save button
        $imagesHelp.html(`Nothing to upload <i class="fas fa-check-circle text-green-500 animate__animated animate__heartBeat"></i>`);
        // enableSave();
        return;
    }

    buffer.forEach(file => {
        let formData = new FormData();
        let $progressBar = file.$clone.find('.progress-bar');
        $progressBar.data('name', file.name); // set file name, for primary
        formData.append('image', file);

        // Upload image
        awaitPromises.push(axios.post(url, formData, {
            onUploadProgress(progressEvent) {
                console.log('progressEvent', progressEvent)
                console.log('progressEvent', progressEvent)
                console.log('progressEvent', progressEvent)
                if (progressEvent.lengthComputable) {
                    let percentComplete = progressEvent.loaded / progressEvent.total;
                    percentComplete = Math.round(percentComplete * 100);
                    $progressBar.attr('aria-valuenow', percentComplete)
                        .css('width', percentComplete + '%')
                        .text(`${percentComplete}%`);

                    if (percentComplete === 100) { // remove bar
                        // setTimeout(function () {
                        // $progressBar.remove();
                        // }, 2999);
                    }
                }
            }
        })
            .then((result) => {
                console.log('Success', file)
                console.log('Result', result)
                file.tempFilePath = result.data.path;
                uploadedImages.push(file); // adding to uploadedImages
                return result;
            })
            .catch((e) => {
                console.log('Error', e)
                const errors = e.response.data.errors;
                enableSave();
                // Show message
                new Noty({
                    type: 'error',
                    text: `${xCircle}<i class="fas fa-exclamation-triangle"></i> ${e.response.data.message}`
                }).show();
                // Show errors
                for (const p in errors) {
                    if (errors.hasOwnProperty(p)) {
                        errors[p].forEach(i => {
                            new Noty({
                                type: 'warning', text: `${xCircle}<i class="fas fa-exclamation-circle"></i> ${i}`
                            }).show();
                        })
                    }
                }
            }));
    })

    // Done uploading images
    Promise.all(awaitPromises)
        .then((results) => {
            enableSave();
            new Noty({
                type: 'success',
                text: `${xCircle}<i class="fas fa-check-circle animate__animated animate__heartBeat"></i> Uploaded ${results.length} files`
            }).show();
            $imagesHelp.html(`${results.length} file${results.length > 1 ? 's' : ''} uploaded <i class="fas fa-check-circle text-green-500 animate__animated animate__heartBeat"></i>`);
        });
}

/*
* Enable/Disable Save button
* */
function enableSave() {
    $save.attr('disabled', false)
        .addClass('bg-indigo-600 hover:bg-indigo-700')
        .removeClass('bg-gray-600 hover:bg-gray-700 cursor-not-allowed')
        .find('i')
        .removeClass('fa-spinner fa-spin');
}

function disableSave() {
    $save
        .attr('disabled', true)
        .addClass('bg-gray-600 hover:bg-gray-700 cursor-not-allowed')
        .removeClass('bg-indigo-600 hover:bg-indigo-700')
        .find('i')
        .addClass('fa-spinner fa-spin');
}

function truncateString(str, num) {
    // If the length of str is less than or equal to num
    // just return str--don't truncate it.
    if (str.length <= num) {
        return str
    }
    // Return str truncated with '...' concatenated to the end of str.
    return str.slice(0, num) + '...'
}

