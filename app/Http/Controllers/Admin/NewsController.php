<?php

namespace App\Http\Controllers\Admin;

use App\Enums\NewsStatus;
use App\Http\Controllers\Controller;
use App\Queries\CategoriesQueryBuilder;
use Illuminate\Http\Request;
use Illuminate\View\View;

use App\Models\News;
use App\Queries\NewsQueryBuilder;

class NewsController extends Controller
{

    public function __construct(
        protected NewsQueryBuilder $newsQueryBuilder,
        protected CategoriesQueryBuilder $categoriesQueryBuilder
    ) {
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.news.index', [
            'newsList'  => $this->newsQueryBuilder->getAll()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.news.create', [
            'categories' => $this->categoriesQueryBuilder->getAll()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string'],
        ]);

        $categories = $request->input('categories');

        $news = $request->only('title', 'description', 'author', 'status');
        $news = News::create($news);

        if ($news !== false) {
            if ($categories !== null) {
                $news->categories()->attach($categories);

                return redirect()->route('admin.news.index')->with('success', 'News has been created');
            }
        }
        return back()->with('error', 'News has not been created');
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        return view('admin.news.edit', [
            'news' => $news,
            'categories' => $this->categoriesQueryBuilder->getAll()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        $categories = $request->input('categories');
        $news = $news->fill($request->only('title', 'description', 'author', 'status'));

        if($news->save()) {
            $news->categories()->sync($categories);
            return redirect()->route('admin.news.index')->with('success', 'News has been update');
        }

        return back()->with('error', 'News has not been update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        News::find($id)->delete();
    }
}
