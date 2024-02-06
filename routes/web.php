<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DocsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InstrumentController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SchedulerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('home');


Route::get('/home', [HomeController::class, 'index'])
    ->name('home.index');

// about page
Route::get('/about', [HomeController::class, 'about'])
    ->name('about');

// services page
Route::get('/services', [HomeController::class, 'services'])
    ->name('services');

// contact page
Route::get('/contact', [HomeController::class, 'contact'])
    ->name('contact');

// gallery
Route::get('/gallery', [HomeController::class, 'gallery'])
    ->name('gallery');

/*
 * Authenticated Users
 * */
Route::middleware('auth')->group(function () {
    /* ------------------------------------------------ */
    /*  ---------------- Basic Pages Routes ----------- */
    /*------------------------------------------------- */








    Route::get('/dashboard', [HomeController::class, 'dashboard'])
        ->middleware(['auth', 'verified'])
        ->name('dashboard');

    Route::get('/documents', [HomeController::class, 'documents'])
        ->name('documents.index');

    Route::get('/messages', [MessagesController::class, 'index'])
        ->name('messages.index');


    /* ------------------------------------------------ */
    /*  ---------------- Docs Routes ------------------ */
    /*------------------------------------------------- */

    // Shared routes
    Route::get('/shared', [DocsController::class, 'shared'])->name('shared.index');

    // Document routes
    Route::post('/save/doc', [DocsController::class, 'store'])->name('docs.store');
    Route::get('/doc/{id}', [DocsController::class, 'show'])->name('docs.show');
    Route::patch('/doc/{id}', [DocsController::class, 'update'])->name('docs.update');
    Route::delete('/doc/{id}', [DocsController::class, 'destroy'])->name('docs.destroy');
    // Get all docs for the user
    Route::get('/docs', [DocsController::class, 'getDocs'])->name('docs.getDocs');





    /* ------------------------------------------------ */
    /*  ---------------- Profile Routes --------------- */
    /*------------------------------------------------- */
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    /* ------------------------------------------------ */
    /*  ---------------- Settings --------------------- */
    /*------------------------------------------------- */
    Route::get('/settings', function () {
        return view('pages.settings');
    })->name('settings.index');
});

require __DIR__ . '/auth.php';
