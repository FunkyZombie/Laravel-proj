<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = $this->getNews();
        
        return view('news.index', [
            'news' => $news
        ]);
    }

    public function show(int $id) 
    {
        $news = $this->getNews($id);

        return view('news.show', [
            'news' => $news
        ]);
    }

    public function category(string $prefix) 
    {

        $news = $this->getNews( null, $prefix);

        return view('news.category', [
            'news' => $news
        ]);
    }
}