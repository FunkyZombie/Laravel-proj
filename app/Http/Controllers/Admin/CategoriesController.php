<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string'],
        ]);

        $category = $request->only('title', 'description');

        $category = Category::create($category);

        if ($category !== false) {
            return redirect()->route('admin.categories.index')->with('success', 'Category has been created');
        }

        return back()->with('error', 'Category has not been created');
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
    public function update(Request $request, Category $category)
    {
        $category = $category->fill($request->only('title', 'description'));

        if($category->save()) {
            return redirect()->route('admin.categories.index')->with('success', 'Category has been update');
        }

        return back()->with('error', 'Category has not been update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::find($id)->delete();
    }
}