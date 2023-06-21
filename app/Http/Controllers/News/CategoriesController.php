<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoriesController extends Controller
{
    public function index(): View
    {
        $news = $this->getNews( null);

        return view('news.categories', [
            'news' => $news
        ]);
    }
}

