import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    // base: process.env.NODE_ENV === 'production' ? '/assets/' : '/',
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/admin.css',
                'resources/css/home.css',
                'resources/css/documents.css',

                'resources/js/app.js',
                'resources/js/documents.js',
                'resources/js/utils.js',

                'resources/js/admin.js',
                'resources/js/admin/admins.js',
                'resources/js/admin/invoices.js',
                'resources/js/admin/rentals.js',
                'resources/css/admin/rentals.css',
                // todo - other css ^^^
                'resources/js/admin/users.index.js',
            ],
            refresh: true,
        }),
    ],
});
