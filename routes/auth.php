<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImageMetaController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});

/*
 * Admin ONLY
 * */
Route::middleware(['auth', 'admin'])->group(function () {

    /* ------------------------------------------------ */
    /*  ---------------- Admin Routes ----------------- */
    /*------------------------------------------------- */
    Route::get('/admin', [AdminController::class, 'index'])
        ->name('admin');
    Route::resource('imagemeta', ImageMetaController::class);

    /* ------------------------------------------------ */
    /*  ---------------- Dashboard Routes ------------- */
    /*------------------------------------------------- */
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    Route::get('/admin/documents', [AdminController::class, 'documents'])
        ->name('admin.documents.index');

    Route::get('/admin/database', [AdminController::class, 'database'])
        ->name('admin.database');

    Route::get('/admin/admins', [AdminController::class, 'admins'])
        ->name('admin.admins.index');

    /* ------------------------------------------------ */
    /*  ---------------- Rentals Routes --------------- */
    /*------------------------------------------------- */
    Route::get('/admin/rentals', [AdminController::class, 'rentals'])
        ->name('admin.rentals.index');
    Route::post('/admin/rentals', [AdminController::class, 'rentalsStore'])
        ->name('admin.rentals.store');
    Route::patch('/admin/rentals', [AdminController::class, 'rentalsUpdate'])
        ->name('admin.rentals.update');
    Route::delete('/admin/rentals/{id}', [AdminController::class, 'rentalsDestroy'])
        ->name('admin.rentals.destroy');

    /* ------------------------------------------------ */
    /*  ---------------- Invoices Routes -------------- */
    /*------------------------------------------------- */
    Route::get('/admin/invoices', [AdminController::class, 'invoices'])
        ->name('admin.invoices.index');

    Route::post('/admin/invoices', [AdminController::class, 'invoicesStore'])
        ->name('admin.invoices.store');

    Route::patch('/admin/invoices', [AdminController::class, 'invoicesUpdate'])
        ->name('admin.invoices.update');

    Route::delete('/admin/invoices/{id}', [AdminController::class, 'invoicesDestroy'])
        ->name('admin.invoices.destroy');

    /* ------------------------------------------------ */
    /*  ---------------- Profile Routes --------------- */
    /*------------------------------------------------- */
    Route::get('/admin/users', [AdminController::class, 'users'])
        ->name('admin.users.index');

    Route::get('/admin/teachers', [AdminController::class, 'teachers'])
        ->name('admin.teachers.index');

    Route::get('/admin/parents', [AdminController::class, 'parents'])
        ->name('admin.parents.index');

    /* ------------------------------------------------ */
    /*  ---------------- User Routes ------------------ */
    /*------------------------------------------------- */
//    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/user', [UserController::class, 'store'])
        ->name('user.store');
    Route::patch('/user', [UserController::class, 'update'])
        ->name('user.update');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])
        ->name('user.destroy');

    /* ------------------------------------------------ */
    /*  ---------------- API Routes ------------------- */
    /*------------------------------------------------- */
    Route::get('/admin/api/totals', [AdminController::class, 'apiTotals'])
        ->name('admin.api.totals');

    Route::get('/all/users', [AdminController::class, 'allUsers'])
        ->name('admin.allUsers');

    Route::get('/all/admins', [AdminController::class, 'allAdmins'])
        ->name('admin.allAdmins');

});
