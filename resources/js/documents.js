/*
* Dashboard JS
* - https://datatables.net/
* - https://editorjs.io/
* - https://momentjs.com/
* */

import EditorJS from '@editorjs/editorjs';
import Header from '@editorjs/header';
import List from '@editorjs/list';
import Checklist from '@editorjs/checklist';
import LinkTool from '@editorjs/link';
import RawTool from '@editorjs/raw';
import Swal from 'sweetalert2';
import moment from 'moment';

const $docsTable = $('#docs-data-table');
const titleInput = document.getElementById('doc-title');

let activeDoc = null;

/*
* TODO - M or Youcef, add all the tools to editor.js
*
* */
// todo - add config options
/*
* Setup Editor JS
*   https://editorjs.io/
* - Quote
* - Warning
* - Marker
* - Code
* - Delimiter
* - InlineCode
* - LinkTool
* - ImageTool
* - Embed
* - Table
* - Quote
* - Warning
* - Marker
* - Code
* - Delimiter
* - InlineCode
* */
// Initialize Editor.js
let editor = new EditorJS({
    holder: 'editor-js',
    tools: {
        header: {
            class: Header,
            shortcut: 'CMD+SHIFT+H',
            config: {
                placeholder: 'Enter a header',
                // levels: [2, 3, 4],
                // defaultLevel: 3
            }
        },
        list: {
            class: List,
            inlineToolbar: true,
        },
        checklist: {
            class: Checklist,
            inlineToolbar: true,
        },
        linkTool: {
            class: LinkTool,
            config: {
                // todo - figure out how to get this working
                // endpoint: 'http://localhost:8008/fetchUrl', // Your backend endpoint for url data fetching
            }
        },
        raw: RawTool,
    },

    /**
     * onReady callback
     */
    onReady: () => {
        console.log('Editor.js is ready to work!')
    },

    /**
     * onChange callback
     */
    onChange: (api, event) => {
        console.log('Now I know that Editor\'s content changed!', event)
    }
});

// Initialize dataTables
getAllDocs().then(res => {
    const {data} = res.data;
    initDocsTable(data);
}).catch(e => {
    console.log('error: ', e);
    Swal.fire({
        title: 'Error!',
        text: 'Error fetching documents',
        icon: 'error',
    });
});

/*
* Event listeners
* */
// Handle save button click
document.getElementById('save')
    .addEventListener('click', handleSaveClick);

// Handle clear button click
document.getElementById('clear')
    .addEventListener('click', clearEditor);

function clearEditor() {
    activeDoc = null; // set activeDoc to null
    titleInput.value = ''; // clear title input
    editor.clear(); // clear editor
}

function handleSaveClick() {
    // get title
    const title = titleInput.value.trim();
    if (!title) {
        Swal.fire({
            title: 'Title?',
            text: 'Please enter a title',
            icon: 'warning',
        })
    } else {
        editor.save().then((outputData) => {
            // check for content
            if (outputData.blocks.length === 0) {
                Swal.fire({
                    title: 'Content?',
                    text: 'Please enter some content',
                    icon: 'warning',
                })
                return;
            }

            // add title to outputData
            outputData.title = title;

            let savePromise;
            if (activeDoc) {
                // add id to outputData
                outputData.id = activeDoc.id;
                // Updating an existing document
                savePromise = axios.patch(`/doc/${activeDoc.id}`, outputData);
            } else {
                // Creating a new document
                savePromise = axios.post('/save/doc', outputData);
                // Clear the editor
                clearEditor();
            }

            savePromise.then(function (response) {
                const {data} = response.data;
                // Check if the response is 204 - No Content
                if (response.status === 204) { // 204 - No Content
                    // Find the row index for the active document
                    const rowIndex = $docsTable.DataTable().rows().indexes().filter((index) => {
                        let rowData = $docsTable.DataTable().row(index).data();
                        return rowData.id === activeDoc.id;
                    });
                    // Check if the row exists, if so, update the row data from outputData
                    if (rowIndex.length > 0) {
                        // Update the row data
                        $docsTable.DataTable().row(rowIndex[0]).data({
                            id: outputData.id,
                            title: outputData.title,
                            created: moment(outputData.created_at).format('MMMM Do YYYY, h:mm:ss a'),
                            updated: moment(outputData.updated_at).format('MMMM Do YYYY, h:mm:ss a')
                        }).draw();
                    }
                } else {
                    // Add a new row to DataTable, using the response data
                    $docsTable.DataTable().row.add({
                        id: data.id,
                        title: data.title,
                        created: moment(data.created_at).format('MMMM Do YYYY, h:mm:ss a'),
                        updated: moment(data.updated_at).format('MMMM Do YYYY, h:mm:ss a')
                    }).draw();
                }
            }).catch(function (error) {
                console.log(error);
                Swal.fire({
                    title: 'Error!',
                    text: 'Saving failed',
                    icon: 'error',
                });
            });
        }).catch((error) => {
            console.log('Saving failed: ', error);
            Swal.fire({
                title: 'Error!',
                text: 'Editor saving failed',
                icon: 'error',
            });
        });
    }
}

/*
* Docs table
* - https://datatables.net/
* */

// Initialize dataTables
function initDocsTable(data) {
    console.log('data: ', data)
    let deleteButton = `
        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 border border-red-700 rounded delete">
            <i class="fa-solid fa-trash-can mr-1"></i>
            Delete
        </button>
    `;
    // Format the data
    const $data = data.map(doc => {
        return {
            id: doc.id,
            title: doc.title,
            created: moment(doc.created_at).format('MMMM Do YYYY, h:mm:ss a'),
            updated: moment(doc.updated_at).format('MMMM Do YYYY, h:mm:ss a'),
        }
    });
    // Initialize DataTables
    $docsTable.DataTable({
        data: $data,
        columns: [
            {data: 'id'},
            {data: 'title'},
            {data: 'created'},
            {data: 'updated'},
            {
                data: null, // This column does not correspond to any data field
                defaultContent: deleteButton, // Delete button
                orderable: false // Disable sorting for this column
            }
        ]
    });

    // Docs table catch delete button click
    $docsTable.on('click', '.delete', function (e) {
        e.stopPropagation();
        const $row = $(this).closest('tr');
        const id = $row.find('td:first-child').text();
        deleteDoc(id).then(res => {
            // Use DataTable API to remove the row
            $docsTable.DataTable().row($row).remove().draw();
            clearEditor();
        }).catch(e => {
            console.log('error: ', e);
            Swal.fire({
                title: 'Error!',
                text: 'Error deleting document',
                icon: 'error',
            });
        });
    });

    // DataTable row click event
    $docsTable.on('click', 'tbody tr', function () {
        // Remove active class from all rows
        $docsTable.find('tbody tr').removeClass('active-row');
        // Add active class to the clicked row
        const $row = $(this);
        $row.addClass('active-row');
        const docId = $row.find('td:first-child').text(); // Assuming first column contains the ID
        // check if editor is empty, if so, skip this
        if ($docsTable.DataTable().row(this).data()) {
            loadDocIntoEditor(docId);
        }
    });
}

// Function to load a doc into Editor.js
function loadDocIntoEditor(docId) {
    // Get the document from the server
    axios.get(`/doc/${docId}`).then(res => {
        const {data} = res.data;
        // set activeDoc
        activeDoc = data;
        // Set the title in the input field
        if (titleInput) {
            titleInput.value = activeDoc.title; // Assuming the title is in docData.title
        }
        // Load new data into Editor.js
        editor.render(activeDoc);
    }).catch(error => {
        console.error('Error: ', error);
        Swal.fire({
            title: 'Error!',
            text: 'Error fetching document',
            icon: 'error',
        });
    });
}

// Get all docs
function getAllDocs() {
    return axios.get('/docs');
}

// Delete doc
function deleteDoc(id) {
    return axios.delete(`/doc/${id}`);
}
