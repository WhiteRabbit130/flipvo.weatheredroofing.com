/*
* utils.js
*
* - This file contains utility functions that are used in multiple files
* */

import Swal from 'sweetalert2';
import moment from 'moment';
import axios from 'axios';
import $ from 'jquery';
import DataTable from 'datatables.net-dt';


// Initialize DataTables
// initUsersTable('teacher');

const deleteButton = `
            <button class="btn btn-danger btn-sm py-1 px-4 bg-red-500 hover:bg-red-700 text-white delete">
                <i class="fa-solid fa-trash-can"></i>
            </button>`;
export {deleteButton};

const usersIcon = `<div class="text-center">
            <i class="fa-solid fa-users"></i>
        </div>`;

// admins icon
const adminsIcon = `<div class="text-center">
            <i class="fa-solid fa-user-shield"></i>
        </div>`;

const teacherIcon = `<div class="text-center">
            <i class="fa-solid fa-chalkboard-teacher"></i>
        </div>`;

const parentIcon = `<div class="text-center">
            <i class="fas fa-user-friends"></i>
        </div>`;

const studentIcon = `<div class="text-center">
            <i class="fas fa-user-graduate"></i>
        </div>`;


function initUsersTable(type, $table) {
    let url = null;
    const DELETE_URL = '/user/';
    let typeIcon = '';

    switch (type) {
        case 'admins':
            url = '/all/admins';
            typeIcon = adminsIcon;
            break;
        case 'teacher':
            url = '/all/teachers';
            typeIcon = teacherIcon;
            break;
        case 'parent':
            url = '/all/parents';
            typeIcon = parentIcon;
            break;
        case 'student':
            url = '/all/students';
            typeIcon = studentIcon;
            break;
        default:
            url = '/all/users';
            typeIcon = usersIcon;
    }

    // Get the data
    axios.get(url).then(res => {
        const {data} = res;
        console.log(res)

        // Format the data
        const tableData = data.map(n => {
            return {
                id: n.id,
                name: n.name,
                type: n.type,
                email: n.email,
                created: moment(n.created_at).format('MMMM Do YYYY, h:mm:ss a'),
            }
        });

        const columns = [
            {data: 'id'},
            {data: 'name'},
            {
                data: null,
                defaultContent: typeIcon,
                orderable: false
            },
            {data: 'type'},
            {data: 'email'},
            {
                data: 'created',
                width: '200px',
            },
            // Delete button
            {
                data: null, // This column does not correspond to any data field
                defaultContent: deleteButton, // Delete button
                orderable: false // Disable sorting for this column
            }
        ];

        // Initialize DataTables
        $table.DataTable({
            data: tableData,
            columns,
            columnDefs: [
                {
                    targets: [0],
                    visible: false,
                    searchable: false
                },
                {
                    targets: [2],
                    className: 'text-center'
                },
                {
                    targets: [3],
                    className: 'text-center'
                },
                {
                    targets: [4],
                    className: 'text-center'
                },
                // Created at
                {
                    targets: 5,
                    // width: '200px',
                    className: 'text-center no-wrap p-1'
                },
                {
                    targets: [6],
                    visible: false,
                    className: 'text-center'
                }
            ],
        });
    }).catch((e) => {
        console.log(e);
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Something went wrong!",
        });
    });

    // Delete button handler
    $table.on('click', '.delete', function (e) {
        let $row = $(this).closest('tr');
        let id = $row.find('td:first-child').text();
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true, // Show cancel button
            confirmButtonColor: '#3085d6', // Blue button
            cancelButtonColor: '#d33', // Red button
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Delete the instrument
                axios.delete(DELETE_URL + id).then(res => {
                    console.log(res);
                    Swal.fire({
                        title: 'Deleted!',
                        text: 'User deleted',
                        icon: 'success',
                    });
                    // Remove the row from the table
                    $table.DataTable().row($row).remove().draw();
                }).catch((e) => {
                    console.log(e);
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!",
                    });
                });
            }
        });
    });
}

export {initUsersTable};

document.addEventListener('DOMContentLoaded', () => {

    console.log('utils.js - DOMContentLoaded');
    // Initialize DataTables
    // const $table = $('#users-table');
    // if ($table.length > 0) {
    //     initUsersTable('user', $table);
    // }
    // const $teacherTable = $('#teachers-table');
    // if ($teacherTable.length > 0) {
    //     initUsersTable('teacher', $teacherTable);
    // }
    // const $parentTable = $('#parents-table');
    // if ($parentTable.length > 0) {
    //     initUsersTable('parent', $parentTable);
    // }
    // const $studentTable = $('#students-table');
    // if ($studentTable.length > 0) {
    //     initUsersTable('student', $studentTable);
    // }
    //


    // Hide the spinner
    // setTimeout(() => {
    //     const $spinner = $('.main-spinner');
    //     if ($spinner.length > 0) {
    //         $spinner.fadeOut();
    //     }
    // }, 100);

    // Set the date and time
    let dateTime = setInterval(() => {
        const $dateTime = $('.dateTime');
        // loop through all .dateTime elements
        $dateTime.each(function () {
            const $this = $(this);
            const formattedTime = moment().format('dddd, MMMM Do YYYY, h:mm:ss A');
            $this.html(formattedTime);
        });
    }, 1000);

});
