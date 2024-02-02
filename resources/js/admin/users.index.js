/*
* users.index.js
* - This file is the entry point for the admin dashboard
* */

import $ from 'jquery';

import {initUsersTable} from "../utils.js";

let $table = $('#users-table');

initUsersTable('all', $table);
