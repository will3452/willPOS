<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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
    return 'willpos, comming soon!';
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function(){
    
    Route::prefix('products')->name('products.')->group(function(){
        Route::post('/', [ProductController::class, 'store'])->name('store');
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::delete('/{id}', [ProductController::class, 'destroy'])->name('remove');
        Route::put('/{id}', [ProductController::class, 'update'])->name('update');
        Route::get('/{id}', [ProductController::class, 'show'])->name('show');
    });

});
