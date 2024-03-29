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

Auth::routes();

Route::get('/', [App\Http\Controllers\CategoryController::class, 'index'])->name('home');
Route::get('/categories/{category}', [App\Http\Controllers\CategoryController::class, 'show'])->name('categories.show');
Route::get('/products/{category}', [App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
Route::get('/products/{category}/{product}', [App\Http\Controllers\ProductController::class, 'show'])->name('products.show');

/**
 * AUTH ACCESS
 */
Route::middleware(['auth'])
    ->name('crm.')
    ->prefix('crm')
    ->group(static function () {
        Route::get('/', [App\Http\Controllers\CRM\CrmController::class, 'index'])->name('home');
        Route::resource('/users', App\Http\Controllers\CRM\UserController::class);
        Route::resource('/info', App\Http\Controllers\CRM\CategoryController::class);
        Route::resource('/events', App\Http\Controllers\CRM\ProductController::class);
    });

