<?php

namespace App\Http\Controllers\News;

use App\Enums\NewsStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

use App\Models\News;
use App\Queries\CategoriesQueryBuilder;
use App\Queries\NewsQueryBuilder;
use App\Queries\QueryBuilder;

class NewsController extends Controller
{
    public function __construct(
        protected NewsQueryBuilder $newsQueryBuilder,
        protected CategoriesQueryBuilder $categoriesQueryBuilder
    ) {
    }

    public function __invoke(Request $request): View
    {
        return view('news.index', [
            'news' => $this->newsQueryBuilder->getActive()
        ]);
    }

    public function show(News $news): View
    {

        return view('news.show', [
            'news' => $news
        ]);
    }
}