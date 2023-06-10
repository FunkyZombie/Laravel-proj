<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>Document</title>
</head>
<body>
<?php

    use App\Http\Controllers\MainController;
    use App\Http\Controllers\NewsController;

    use Illuminate\Support\Facades\Route;

    Route::get('/', [MainController::class, 'index']);
    Route::get('/news', [NewsController::class, 'index']);
    Route::get('/news/{id}', [NewsController::class, 'show']);

?>
</body>
</html>