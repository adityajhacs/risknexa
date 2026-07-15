<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Framework;
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
    $frameworks = Framework::where('status', 'Active')
                    ->orderBy('name')
                    ->get();

    return view('categories.create', compact('frameworks'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'framework_id'  => 'required|exists:frameworks,id',
        'code'          => 'required|max:50',
        'name'          => 'required|max:255',
        'description'   => 'nullable',
        'display_order' => 'nullable|integer',
        'status'        => 'required|in:Active,Inactive',
    ]);

    Category::create($validated);

    return redirect()
            ->route('categories.index')
            ->with('success', 'Section created successfully.');
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
      $request->validate([
    'name' => 'required'
]);
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
