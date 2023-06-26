<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NewsController extends Controller
{

    public function __invoke(Request $request): View
    {
        $news = $this->getNews();
        
        return view('news.index', [
            'news' => $news,
        ]);
    }

    public function show(int $id): View
    {
        $news = $this->getNews($id);

        return view('news.show', [
            'news' => $news
        ]);
    }
}