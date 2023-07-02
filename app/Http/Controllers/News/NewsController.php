<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

use App\Models\News;

class NewsController extends Controller
{
    public function __invoke(Request $request): View
    {
        $model = app(News::class);

        $news = $model->getNews();

        return view('news.index', [
            'news' => $news,
        ]);
    }

    public function show(int $id): View
    {
        $model = app(News::class);

        $news = $model->getNewsById($id);

        return view('news.show', [
            'news' => $news
        ]);
    }
}