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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Кэш очищен.";
})->name('clear.cash');


Route::group(['prefix' => 'admin'], function () {

    Route::get('/', [\App\Http\Controllers\Admin\MainController::class, 'index'])->name('admin.index');
    Route::post('/drop-remove-file',[\App\Http\Controllers\Admin\DropzoneController::class, 'removeOne'])->name('dropzone.remove.one');

    Route::resource('/slider', \App\Http\Controllers\Admin\Content\SliderController::class);
    Route::post('/slider-img-upload',[\App\Http\Controllers\Admin\Content\SliderController::class, 'imgUpload'])->name('slider.img.upload');
    Route::post('/slider-img-update',[\App\Http\Controllers\Admin\Content\SliderController::class, 'imgUpdate'])->name('slider.img.update');
    Route::post('/slider-img-update-remove',[\App\Http\Controllers\Admin\Content\SliderController::class, 'imgRemoveForUpdate'])->name('slider.img.remove');

    Route::resource('/category', \App\Http\Controllers\Admin\Catalog\CategoryController::class);

    Route::post('/category-img-upload',[\App\Http\Controllers\Admin\Catalog\CategoryController::class, 'imgUpload'])->name('category.img.upload');
    Route::post('/category-img-update',[\App\Http\Controllers\Admin\Catalog\CategoryController::class, 'imgUpdate'])->name('category.img.update');
    Route::post('/category-img-update-remove',[\App\Http\Controllers\Admin\Catalog\CategoryController::class, 'imgRemoveForUpdate'])->name('category.img.remove');
    Route::post('/category-thumb-update',[\App\Http\Controllers\Admin\Catalog\CategoryController::class, 'thumbUpdate'])->name('category.thumb.update');
    Route::post('/category-thumb-update-remove',[\App\Http\Controllers\Admin\Catalog\CategoryController::class, 'thumbRemoveForUpdate'])->name('category.thumb.remove');

    Route::get('/currency', [\App\Http\Controllers\Admin\Catalog\CurrencyController::class, 'index'])->name('currency.index');
    Route::get('/get-currency', [\App\Http\Controllers\Admin\Catalog\CurrencyController::class, 'get'])->name('get_currency');
    Route::get('/update-prices', [\App\Http\Controllers\Admin\Catalog\CurrencyController::class, 'updatePrices'])->name('update_prices');

    Route::resource('/color', \App\Http\Controllers\Admin\Catalog\ColorController::class);
});







