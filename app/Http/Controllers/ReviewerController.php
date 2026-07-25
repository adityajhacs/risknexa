<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Assessment;

class ReviewerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()->user()->role != 'company_admin')
        {
            abort(403);
        }

        $reviewers = User::where('role', 'reviewer')->get();

        return view(
            'reviewers.index',
            compact('reviewers')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('reviewers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    
    public function store(Request $request)
    {
        User::create([
    'name' => $request->name,
    'email' => $request->email,
    'password' => Hash::make($request->password),

    'role' => 'reviewer'
]);

return redirect()
    ->route('reviewers.index')
    ->with('success','Reviewer Created Successfully.');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function assessmentOverview(Assessment $assessment)
{
    $assessment->load([
        'vendor',
        'framework',
        'questions.domain'
    ]);

    $domains = $assessment->questions
        ->groupBy(function ($question) {
            return $question->domain->id;
        });

    return view(
        'reviewers.assessment-overview',
        compact('assessment', 'domains')
    );
}
}