<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Auth;
class CategoriesController extends Controller
{
    public function index()
    {
        $categories  = Category::where('user_id','=',Auth::user()->id)->get();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $categories = new Category();
        $categories->name = $request->name;
        $categories->user_id = Auth::user()->id;
        // $categories->user_id = 1;
        $categories->save();
        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $categories = Category::find($id);
        $categories->name = $request->name;
        $categories->user_id = Auth::user()->id;
        // $categories->user_id = 1;
        $categories->save();
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        Category::destroy($id);
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}