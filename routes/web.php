
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>Document</title>
</head>

<?php


use App\Http\Controllers\MainController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\CategoryController as AmdinCategoryController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::resource('category', AmdinCategoryController::class);
    Route::resource('news', AdminNewsController::class);
});

Route::get('/', [MainController::class, 'index']);
Route::get('/news', [NewsController::class, 'index']);

Route::get('/news/{id}', [NewsController::class, 'show'])
    ->where('id', '\d+')
    ->name('news.show');
Route::get('/{prefix}', [NewsController::class, 'category'])
    ->name('news.category');
?>
