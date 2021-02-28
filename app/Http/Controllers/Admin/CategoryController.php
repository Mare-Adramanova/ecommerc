<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        
        return view('admin.category.index', ['categories'=>$categories]);
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required'
            
        ]);

        Category::create($request->all());
        return redirect()->route('admin.categories.index');

    }

    public function show(Category $category)
    {
        
        return view('admin.category.detailed', ['category'=>$category]);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back();
    }

    public function edit(Category $category)
    {
        
        return view('admin.category.edit', ['category'=>$category]);
    }

    public function update(Category $category, Request $request)
    {
        $request->validate([
            'type'    =>  'required'
            
        ]);
        
        $category->update($request->all());
        return redirect()->route('admin.categories.index');
    }


}
