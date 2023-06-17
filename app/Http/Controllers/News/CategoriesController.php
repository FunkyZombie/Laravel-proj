<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $news = $this->getNews( null);

        return view('news.categories', [
            'news' => $news
        ]);
    }
}

