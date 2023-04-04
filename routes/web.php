<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\TaskController;
use App\Models\Task;
use Illuminate\Support\Facades\Redirect;
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

Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
    Route::view('register-email', 'auth.register-email')->name('register-email-page');
    Route::post('send-verification-email', [EmailVerificationController::class, 'store'])->name('send-verification-email');
    Route::get('verify/{token}', [EmailVerificationController::class, 'verify'])->middleware('email-verification')->name('verify-email');

    Route::get('register/{email}', [AuthController::class, 'registerPage'])->name('register-page');
    Route::patch('register/{user}', [AuthController::class, 'update'])->name('register');

    Route::view('login', 'auth.login')->name('login-page');
    Route::post('login', [AuthController::class, 'login'])->name('login');

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::group(['middleware' => 'auth', 'prefix' => 'tasks', 'as' => 'tasks.'], function () {
    Route::get('/', [TaskController::class, 'index'])->name('index');
    Route::post('store', [TaskController::class, 'store'])->name('store');
    Route::patch('{task}/update', [TaskController::class, 'update'])->name('update');
    Route::patch('{task}/complete', [TaskController::class, 'complete'])->name('complete');
    Route::delete('{task}/delete', [TaskController::class, 'destroy'])->name('destroy');
    Route::view('search', 'tasks.search')->name('search-page');
    Route::post('search', [TaskController::class, 'search'])->name('search');
});

Route::fallback(fn () => to_route('auth.login-page'));
