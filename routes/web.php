<?php

use App\Http\Controllers\ListController;
use App\Http\Controllers\UserController;
use App\Models\Lists;
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
        return Inertia\Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/users', [UserController::class, 'index'])->name('users');

    Route::get('/lists', [ListController::class, 'index'])->name('lists');
    Route::get('/lists/{slug}', [ListController::class, 'show'])->name('lists.show');


    Route::get('/lists/create', function () {
        return Inertia\Inertia::render('Lists/Create');
    })->name('lists/create');

    Route::get('/lists/{slug}/edit', function () {
        return Inertia\Inertia::render('Lists/Edit');
    })->name('lists/edit');
});
