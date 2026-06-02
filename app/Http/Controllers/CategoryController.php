<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Category::create([
        'name' => $request->name,
        'description' => $request->description,
    ]);

    return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
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
    return view('categories.edit', compact('category'));
}

public function update(Request $request, Category $category)
{
    $category->update([
        'name' => $request->name,
        'description' => $request->description,
    ]);

    return redirect()->route('categories.index');
}

public function destroy(Category $category)
{
    $category->delete();

    return redirect()->route('categories.index');
}
}
