<?php

use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\Auth\EmailVerificationController;
use App\Http\Controllers\API\LoanController;
use App\Http\Controllers\API\BookController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::post('forgot-password', [AuthController::class, 'forgotPassword'])->name('forget.password.post');
Route::get('reset-password/{token}', [AuthController::class, 'checkResetPasswordToken'])->name('reset.password.get');
Route::post('reset-password', [AuthController::class, 'passwordReset'])->name('password.update');;

Route::get('email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->name('verification.verify')->middleware(['signed']);
Route::get('email/resend', [EmailVerificationController::class, 'resend'])->name('verification.resend');


Route::middleware(['auth:api', 'verified'])->group(function () {
    //Route::get('products', [ProductController::class, 'index']);
});

Route::post('books/{bookId}/{readerId}/rent', [LoanController::class, 'rent']);
Route::get('books', [BookController::class, 'index']);
Route::post('book', [BookController::class, 'store']);
Route::get('book/{id}', [BookController::class, 'show']);
Route::put('book/{id}', [BookController::class, 'update']);
Route::delete('book/{id}', [BookController::class, 'destroy']);
