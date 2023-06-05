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

Auth::routes();

  Route::get('/products', [App\Http\Controllers\ProductController::class, 'productsindex'])->name('products');
        Route::get('products.create', [App\Http\Controllers\ProductController::class, 'productscreate'])->name('products.create');
        Route::post('products.store', [App\Http\Controllers\ProductController::class, 'productsstore'])->name('products.store');
        Route::get('products.show/{slug}', [App\Http\Controllers\ProductController::class, 'productsshow'])->name('products.show');
        
        Route::get('products.archive', [App\Http\Controllers\ProductController::class, 'productsarchive'])->name('products.archive');
        Route::get('products.archivereturn/{id}', [App\Http\Controllers\ProductController::class, 'productsarchivereturn'])->name('products.archivereturn');
        Route::get('products.archivedistroy/{id}', [App\Http\Controllers\ProductController::class, 'productsarchivedistroy'])->name('products.archivedistroy');
        Route::post('products.archivemultipledelete', [App\Http\Controllers\ProductController::class, 'productsarchivemultipledelete'])->name('products.archivemultipledelete');

        Route::get('products.edit/{id}', [App\Http\Controllers\ProductController::class, 'productsedit'])->name('products.edit');
        Route::post('products.update', [App\Http\Controllers\ProductController::class, 'productsupdate'])->name('products.update');
        Route::post('products.delete', [App\Http\Controllers\ProductController::class, 'productsdestroy'])->name('products.delete');
        Route::get('products.publish/{id}', [App\Http\Controllers\ProductController::class, 'productspublish'])->name('products.publish');
        Route::get('products.unpublish/{id}', [App\Http\Controllers\ProductController::class, 'productsunpublish'])->name('products.unpublish');
        Route::post('products.multipledelete', [App\Http\Controllers\ProductController::class, 'productsmultipledelete'])->name('products.multipledelete');
  
        // pagination
        Route::get('pagination/paginate-data', [App\Http\Controllers\ProductController::class, 'productspagination']);
        // Search
        Route::post('products.search', [App\Http\Controllers\ProductController::class, 'productssearch'])->name('products.search');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');