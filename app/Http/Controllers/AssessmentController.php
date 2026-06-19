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
        
    $assessments = Assessment::with(
        'questions',
        'vendor'
    )->get();

    foreach ($assessments as $assessment) {

        $score = $assessment->questions->sum(
            'risk_weight'
        );

        $assessment->risk_score = $score;

        if ($score <= 25) {
            $assessment->risk_level = 'Low';
        } elseif ($score <= 50) {
            $assessment->risk_level = 'Medium';
        } elseif ($score <= 75) {
            $assessment->risk_level = 'High';
        } else {
            $assessment->risk_level = 'Critical';
        }
    }

    return view(
        'assessments.index',
        compact('assessments')
    );

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

    'questionnaire' => $request->questionnaire,
    'priority' => $request->priority,
    'assigned_by' => $request->assigned_by,
    'reviewer' => $request->reviewer,
    'review_status' => $request->review_status,
]);

return redirect('/assessments');
    }

    /**
     * Display the specified resource.
     */
  public function show(Assessment $assessment)
{$assessment->load([
    'vendor',
    'assessmentQuestions.question',
    'evidenceUploads'
]);
    $riskScore = $assessment->risk_score;
    $riskLevel = $assessment->risk_level;
    $answeredQuestions = $assessment
    ->assessmentQuestions
    ->whereNotNull('response')
    ->count();

$totalQuestions = $assessment
    ->assessmentQuestions
    ->count();

$evidenceCount = $assessment
    ->evidenceUploads
    ->count();

    return view(
        'assessments.show',
        compact(
            'assessment',
            'riskScore',
            'answeredQuestions',
'totalQuestions',
'evidenceCount',
            'riskLevel'
        )
    );
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
   public function review(
    Request $request,
    Assessment $assessment
)
{
    $outcome = null;

    if ($assessment->risk_level == 'Low') {

        $outcome = 'Approved';

    } elseif ($assessment->risk_level == 'Medium') {

        $outcome = 'Conditionally Approved';

    } else {

        $outcome = 'Rejected';

    }

    $assessment->update([
        'review_status' => $request->review_status,
        'governance_outcome' => $outcome
    ]);

    return back();
}
}
