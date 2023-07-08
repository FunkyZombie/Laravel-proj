<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Categories\Store;
use App\Http\Requests\Categories\Update;
use App\Models\Category;
use App\Queries\CategoriesQueryBuilder;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoriesController extends Controller
{

    public function __construct(
        protected CategoriesQueryBuilder $categoriesQueryBuilder
    ) {
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.categories.index', [
            'categories' => $this->categoriesQueryBuilder->getAll()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Store $request)
    {
        $category = Category::create($request->validated());

        if ($category !== false) {
            return redirect()->route('admin.categories.index')->with('success', __('Category has been created'));
        }

        return back()->with('error', __('Category has not been created'));
    }


     /* Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', [
            'category' => $category, 
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Update $request, Category $category)
    {
        $category = $category->fill($request->validated());

        if($category->save()) {
            return redirect()->route('admin.categories.index')->with('success', __('Category has been updated'));
        }

        return back()->with('error', __('Category has not been updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();

            return \response()->json('ok', 200);
        } catch (\Throwable $exception) {
            \Log::error($exception->getMessage(), $exception->getTrace());

            return \response()->json('error', 400);
        }
    }
}