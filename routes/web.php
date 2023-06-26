<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Main\MainController;

use App\Http\Controllers\News\CategoriesController as NewsCategoriesController;
use App\Http\Controllers\News\NewsController;
use App\Http\Controllers\News\OrderController;

use App\Http\Controllers\Admin\CategoriesController as AdminCategoriesController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\IndexController as AdminController;




Route::group(['prefix' => 'admin', 'as' => 'admin.'], static function () {
    Route::get('/', AdminController::class)
        ->name('index');
    Route::resource('/categories', AdminCategoriesController::class);
    Route::resource('/news', AdminNewsController::class);
});

Route::group(['prefix' => 'news', 'as' => 'news'], static function () {
    Route::get('/', NewsController::class)->name('index');
    Route::resource('/categories', NewsCategoriesController::class);
});

Route::group(['prefix' => '', 'as' => 'main'], static function () {
    Route::get('/', MainController::class)->name('index');
    Route::resource('order', OrderController::class);
});

Route::get('/news/{id}', [NewsController::class, 'show'])
    ->where('id', '\d+')
    ->name('news.show');

Route::view('/info', 'welcome');
    
?>
