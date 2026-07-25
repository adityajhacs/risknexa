<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Framework;

class FrameworkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {$frameworks = Framework::latest()->paginate(10);

    return view('frameworks.index', compact('frameworks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('frameworks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
        'code' => 'required|string|max:50|unique:frameworks,code',
        'name' => 'required|string|max:255',
        'version' => 'nullable|string|max:100',
        'description' => 'nullable|string',
        'status' => 'required|in:Active,Inactive',
    ]);

    $validated['created_by'] = auth()->id();

    Framework::create($validated);

    return redirect()
        ->route('frameworks.index')
        ->with('success', 'Framework created successfully.');
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
   public function edit(Framework $framework)
{
    return view('frameworks.edit', compact('framework'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Framework $framework)
{
    $validated = $request->validate([
        'code' => 'required|max:50|unique:frameworks,code,' . $framework->id,
        'name' => 'required|max:255',
        'version' => 'nullable|max:100',
        'description' => 'nullable',
        'status' => 'required|in:Active,Inactive',
    ]);

    $framework->update($validated);

    return redirect()
        ->route('frameworks.index')
        ->with('success', 'Framework updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
   
    public function destroy(Framework $framework)
{
    $framework->delete();

    return redirect()
        ->route('frameworks.index')
        ->with('success', 'Framework deleted successfully.');
}
}
