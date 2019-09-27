<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Requests\Category\StoreCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index', [
            'categories' => $categories
        ]);
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->update($request->all());
        return redirect()->route('categories.index');
    }

    public function store(StoreCategory $request)
    {
        Category::create($request->all());

        return redirect()->route('categories.index');
    }

    public function edit(Category $category)
    {
        $category = Category::find($category);

        return view('admin.categories.edit', ['category' => $category]);
    }

    public function destroy($id)
    {
        Category::find($id)->delete();

        return redirect()->route('categories.index');
    }
}
