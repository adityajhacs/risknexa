<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assessment;
use App\Models\Vendor;
class AssessmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $assessments = Assessment::all();

    return view('assessments.index', compact('assessments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vendors = Vendor::all();

    return view('assessments.create', compact('vendors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {  $request->validate([
        'vendor_id' => 'required',
        'assessment_name' => 'required',
        'due_date' => 'required',
        'status' => 'required',
    ]);

    Assessment::create([
        'vendor_id' => $request->vendor_id,
        'assessment_name' => $request->assessment_name,
        'due_date' => $request->due_date,
        'status' => $request->status,
    ]);
   
    return redirect('/assessments');
    }

    /**
     * Display the specified resource.
     */
    public function show(Assessment $assessment)
{
    $assessment->load('questions');

    return view('assessments.show', compact('assessment'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Assessment $assessment)
    {
     $vendors = Vendor::all();

    return view('assessments.edit', compact('assessment', 'vendors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Assessment $assessment)
    {  
         $request->validate([
     'vendor_id' => 'required',
    'assessment_name' => 'required',
    'due_date' => 'required',
    'status' => 'required'
]);
        $assessment->update([
        'vendor_id' => $request->vendor_id,
        'assessment_name' => $request->assessment_name,
        'due_date' => $request->due_date,
        'status' => $request->status,
    ]);

    return redirect('/assessments');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Assessment $assessment)
    {
        
    $assessment->delete();

    return redirect('/assessments');

    }
}
