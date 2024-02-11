/************************************************************
 * Flipvo, LLC.
 * - admin.js
 *
 * Author: Chris Nowlan
 * Updated: 1/01/2024
 * Copyright © 2024. Flipvo, LLC. All rights reserved worldwide.
 ************************************************************/

// todo - php - 10M max file size, nginx client_max_file_size 20M;
// todo - show some warnings and do some checking...

console.log('admin.js loaded...')

let user = null;
let mongoUser = null;
const $save = $('.save');
const $imagesHelp = $('#images-help');
const itemOptions = {
    active: true,
    images: [],
    paymentOptions: {}
};
const uploadedImages = [];
const $imageTemplate = $('#image-template');
const xCircle = '<i class="fas fa-times-circle float-right hover:text-red-600"></i>';

const $imagesForm = $('#images-form');

// img container
const $imgContainer = $('.image-container');

/*
* Catch Item Save (Submit)
* **************************/
let $itemForm = $('#item-form');
// todo - set categories []
let $primaryAlert = $('.alert-primary');
let $saleType = $('#sale-type');
// reset saleType
$saleType.val('buy-now');

const $imagesInput = $('#images');


/*
* Handle showing images and uploading images on change
* *********************************************************/
$imagesInput.on('change', function (e) {

    console.log('Images changed...')

    console.log(this)
    console.log(this.files)

    let buffer = [];
    const uploadBuffer = [];
    const max = 6 - uploadedImages.length;

    disableSave();

    $imagesHelp.html(`<i class="fas fa-file-image"></i> ${this.files.length} file${this.files.length > 1 ? 's' : ''} selected`); // Set files selected
    Array.prototype.push.apply(buffer, this.files); // Merge the file list to an array
    buffer = buffer.slice(0, max); // remove extra files

    console.log('buffer', buffer)
    console.log('uploadedImages', uploadedImages)

    // unset height
    $imgContainer.css('height', '');

    // Check max
    if (uploadedImages.length === 6) { // max images
        new Noty({
            type: 'warning',
            text: `${xCircle}<i class="fas fa-exclamation-triangle"></i> 6 Images Max. Delete one first.`
        }).show();
        $imagesHelp.html(`<i class="fas fa-exclamation-triangle"></i> Max Files`);
        enableSave();
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


    return false;

    // Upload all images
    uploadImages(uploadBuffer);
});

$itemForm.submit(function (e) {
    e.preventDefault();
    disableSave();
    // enableSave(); // todo - move this to right place..
    // todo - require some form of payment
    // todo - Update red glow around missing inputs

    // GET EVERYTHING......
    console.log('Submitting.....')
    // Get item info - todo - why did I do this?
    // itemOptions.created = new Date();

    console.log('-----------------------------------------------')
    console.log('form inputs', $(this).serializeArray())
    console.log('-----------------------------------------------')

    const paymentTypes = ['cashApp', 'venmo', 'zelle', 'payPal'];

    // add values to options
    $(this).serializeArray().forEach(i => {
        if (paymentTypes.includes(i.name) && i.value) {
            itemOptions.paymentOptions[i.name] = i.value;
        } else {
            if (!paymentTypes.includes(i.name)) {
                itemOptions[i.name] = i.value
            }
        }
    });

    console.log('-----------------------------------------------')
    console.log('options', itemOptions);
    console.log('-----------------------------------------------')

    if (!itemOptions['title']) {
        new Noty({
            type: 'warning',
            text: `${xCircle}<i class="fas fa-exclamation-triangle"></i> Enter a Title.`
        }).show();
        $('input[name="title"]').focus();
        enableSave();
        return false;
    }
    if (!itemOptions['price']) {
        new Noty({
            type: 'warning',
            text: `${xCircle}<i class="fas fa-exclamation-triangle"></i> Enter a Price.`
        }).show();
        $('input[name="price"]').focus();
        enableSave();
        return false;
    }

    // Check for a payment method
    if (jQuery.isEmptyObject(itemOptions.paymentOptions)) {
        new Noty({
            type: 'warning',
            text: `${xCircle}<i class="fas fa-exclamation-triangle"></i> Enter a Payment Method.`
        }).show();
        $('input[name="cashApp"]').focus();
        enableSave();
        return false;
    }
    // Check for uploadedImages
    if (!uploadedImages.length) {
        new Noty({
            type: 'warning',
            text: `${xCircle}<i class="fas fa-exclamation-triangle"></i> Upload at least 1 Image.`
        }).show();
        enableSave();
        return false;
    }
    // set uploaded images
    uploadedImages.forEach(i => {
        itemOptions.images.push({
            primary: false,
            tempPath: i.tempFilePath,
        })
    })

    // save item
    axios.post('/api/sell/item', itemOptions)
        .then((result) => {
            // console.log('Done saving')
            // console.log('Result', result)
            // show success message
            new Noty({
                type: 'success',
                text: `${xCircle}<i class="fas fa-check-circle animate__animated animate__heartBeat"></i> Item Saved`
            }).show();

            // todo - sending to marketplace, maybe do something else..
            setTimeout(function () {
                window.location.href = "/marketplace";
            }, 999)
        })
        .catch((e) => {
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
                            type: 'warning',
                            text: `${xCircle}<i class="fas fa-exclamation-circle"></i> ${i}`
                        }).show();
                    })
                }
            }
        })
});

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

function showImage(file) {
    let reader = new FileReader();
    let $clone = $imageTemplate.clone(true);
    $clone.attr('id', '')
        .removeClass('d-none')
        .data('name', file.name); // set file name, for primary

    reader.readAsDataURL(file);

    reader.onload = function (e) { // Show preview image
        $clone.find('img').attr('src', e.target.result);
        $clone.appendTo('.image-container');

        // clone again
        // let $pre = $clone.clone(true);
        // $pre.appendTo('.image-container');

        // $clone.clone(true).appendTo('.image-container');

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
                    type: 'error',
                    text: `${xCircle}<i class="fas fa-exclamation-triangle"></i> Error deleting image`
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
    // todo - could save as draft at this point...
    let awaitPromises = [];
    if (!buffer.length) { // Nothing to upload, enable Save button
        $imagesHelp.html(`Nothing to upload <i class="fas fa-check-circle text-green-500 animate__animated animate__heartBeat"></i>`);
        enableSave();
        return;
    }

    buffer.forEach(file => {
        let formData = new FormData();
        let $progressBar = file.$clone.find('.progress-bar');
        $progressBar.data('name', file.name); // set file name, for primary
        formData.append('image', file);

        // Upload image
        awaitPromises.push(
            axios.post('/api/sell/upload', formData, {
                onUploadProgress(progressEvent) {
                    if (progressEvent.lengthComputable) {
                        let percentComplete = progressEvent.loaded / progressEvent.total;
                        // percentComplete = Math.round(x) parseInt(`${percentComplete * 100}`);
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
                                    type: 'warning',
                                    text: `${xCircle}<i class="fas fa-exclamation-circle"></i> ${i}`
                                }).show();
                            })
                        }
                    }
                })
        );
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


+function ($, window, document) {
}(jQuery, window, document);
