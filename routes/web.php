<?php

use App\Http\Controllers\ListController;
use App\Http\Controllers\UserController;
use App\Models\Lists;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Index');
})->name('home');

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/users', [UserController::class, 'index'])->name('users')->middleware('role:Admin');

    Route::get('/lists', [ListController::class, 'index'])->name('lists');
    Route::post('/lists', [ListController::class, 'store'])->name('lists.store');
    Route::get('/lists/create', function () {
        return Inertia::render('List/Create');
    })->name('lists.create');
    Route::get('/lists/{slug}', [ListController::class, 'show'])->name('lists.show');




    /* Route::get('/lists/{slug}/edit', function () {
        return Inertia::render('Lists/Edit');
    })->name('lists/edit'); */
});
