<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Domain;
use App\Models\Category;

class DomainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $domains = Domain::with('category')->latest()->paginate(10);

    return view('domains.index', compact('domains'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $sections = Category::where('status', 'Active')
                    ->orderBy('display_order')
                    ->orderBy('name')
                    ->get();

    return view('domains.create', compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validated = $request->validate([
        'category_id'   => 'required|exists:categories,id',
        'code'          => 'required|max:50',
        'name'          => 'required|max:255',
        'description'   => 'nullable',
        'display_order' => 'nullable|integer',
        'status'        => 'required|in:Active,Inactive',
    ]);

    Domain::create($validated);

    return redirect()
            ->route('domains.index')
            ->with('success', 'Domain created successfully.');
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
   public function edit(Domain $domain)
{
    $sections = Category::where('status', 'Active')
                ->orderBy('display_order')
                ->orderBy('name')
                ->get();

    return view('domains.edit', compact('domain', 'sections'));
}

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, Domain $domain)
{
    $validated = $request->validate([
        'category_id'   => 'required|exists:categories,id',
        'code'          => 'required|max:50',
        'name'          => 'required|max:255',
        'description'   => 'nullable',
        'display_order' => 'nullable|integer',
        'status'        => 'required|in:Active,Inactive',
    ]);

    $domain->update($validated);

    return redirect()
            ->route('domains.index')
            ->with('success', 'Domain updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(Domain $domain)
{
    $domain->delete();

    return redirect()
            ->route('domains.index')
            ->with('success', 'Domain deleted successfully.');
}
}
