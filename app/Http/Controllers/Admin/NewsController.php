<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\Store;
use App\Http\Requests\News\Update;
use App\Queries\CategoriesQueryBuilder;
use App\Services\Contracts\Upload;
use Illuminate\View\View;

use App\Models\News;
use App\Queries\NewsQueryBuilder;
use Illuminate\Support\Facades\Storage;

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
    public function store(Store $request, Upload $upload)
    {
        $requestValid = $request->validated();

        if (array_key_exists('image', $requestValid)) {
            $requestValid['image'] = $upload->create($requestValid['image']);
        }

        $news = News::create($requestValid);
 
        if ($news) {
            $news->categories()->attach($request->getCategories());
            return redirect()->route('admin.news.index')->with('success', __('News has been created'));
        }

        return back()->with('error', __('News has not been created'));
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
    public function update(Update $request, News $news, Upload $upload)
    {
        if ($request->hasFile('image')) {
            $news['image'] = $upload->create($request->file('image'));
        }

        $news = $news->fill($request->validated());

        if($news->save()) {
            $news->categories()->sync($request->getCategories());
            return redirect()->route('admin.news.index')->with('success', __('News has been updated'));
        }

        return back()->with('error', __('News has not been updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        try {
            Storage::disk('public')->delete($news->image);
            $news->delete();
            return \response()->json('ok', 200);
        } catch (\Throwable $exception) {
            \Log::error($exception->getMessage(), $exception->getTrace());

            return \response()->json('error', 400);
        }
    }
}
