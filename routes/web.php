<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('forgot_password', 'auth.reset_password')->name('password.reset');

Route::get('{any}', function () {
    return view('app');
})->where('any', '^((?!api).)*$')
    ->where('any', '^((?!storage).)*$');
