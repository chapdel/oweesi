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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/users', function () {
        return view('users.index');
    })->name('users');

    Route::get('/lists', function () {
        return view('lists.index');
    })->name('lists');

    Route::get('/lists/create', function () {
        return view('lists.create');
    })->name('lists.create');

    Route::get('/lists/{slug}', function () {
        return view('lists.show');
    })->name('lists.show');

    Route::get('/lists/{slug}/edit', function () {
        return view('lists.edit');
    })->name('lists.edit');
});
