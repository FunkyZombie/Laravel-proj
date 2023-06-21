<?php

use App\Http\Controllers\News\CategoriesController as NewsCategoriesController;
use App\Http\Controllers\News\NewsController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\CategoriesController as AdminCategoriesController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\IndexController as AdminIndexController;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], static function () {
    Route::get('/', AdminIndexController::class)->name('admin.index');
    Route::resource('categories', AdminCategoriesController::class);
    Route::resource('news', AdminNewsController::class);
});


Route::get('/', function () {
    return redirect('/news');
});

Route::group(['prefix' => 'news', 'as' => 'news'], static function () {
    Route::resource('categories', NewsCategoriesController::class);
});

Route::get('/news', [NewsController::class, 'index']);
Route::get('/news', [NewsController::class, 'index']);
Route::get('/news/{id}', [NewsController::class, 'show'])
    ->where('id', '\d+')
    ->name('news.show');
?>
