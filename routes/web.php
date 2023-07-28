<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Main\MainController;

use App\Http\Controllers\AccountController;
use App\Http\Controllers\News\CategoriesController as NewsCategoriesController;
use App\Http\Controllers\News\NewsController;
use App\Http\Controllers\News\OrderController;

use App\Http\Controllers\Admin\CategoriesController as AdminCategoriesController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\IndexController as AdminController;
use App\Http\Controllers\Admin\UsersController as AdminUsersController;
use App\Http\Controllers\Admin\ParserController;
use App\Http\Controllers\SocialProvidersController;

Route::group(['middleware' => 'guest'], function() {
    Route::get('/{driver}/redirect', [SocialProvidersController::class, 'redirect'])
        ->where('driver', '\w+')
        ->name('social-providers.redirect');

    Route::get('{driver}/callback', [SocialProvidersController::class, 'callback'])
        ->where('driver', '\w+')
        ->name('social-providers.callback');
});

Route::group(['middleware' => 'auth'], static function () {
    Route::group(['prefix' => 'account'], static function () {
        Route::get('/', AccountController::class)->name('account');
    });

    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'check.admin'], static function () {
        Route::get('/', AdminController::class)
            ->name('index');
        Route::get('/parser', ParserController::class)
            ->name('parser');
        Route::resource('/categories', AdminCategoriesController::class);
        Route::resource('/news', AdminNewsController::class);
        Route::resource('/users', AdminUsersController::class);
    });
});

Route::group(['prefix' => 'news', 'as' => 'news'], static function () {
    Route::get('/', NewsController::class)->name('index');
    Route::resource('/categories', NewsCategoriesController::class);
});

Route::group(['prefix' => '', 'as' => 'main'], static function () {
    Route::view('/', 'welcome')->name('index');
    Route::resource('order', OrderController::class);
});

Route::get('/news/{news}', [NewsController::class, 'show'])
    ->where('news', '\d+')
    ->name('news.show');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
