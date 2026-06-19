<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assessment;
use App\Models\Vendor;
use App\Models\Category;
use App\Models\Question;
use App\Models\AssessmentQuestion;
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
        $categories = Category::all();

return view(
    'assessments.create',
    compact('vendors','categories')
);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { $request->validate([
    'vendor_id' => 'required',
    'assessment_name' => 'required',
    'due_date' => 'required|date',

    'questionnaire' => 'required',
    'priority' => 'required',

    'assigned_by' => 'required',
    'reviewer' => 'required',

    'status' => 'required',
    'review_status' => 'required',
],[
    'vendor_id.required' => 'Please select a vendor.',
    'assessment_name.required' => 'Assessment name is required.',
    'due_date.required' => 'Due date is required.',
]);

 $assessment=   Assessment::create([
    'vendor_id' => $request->vendor_id,
    'assessment_name' => $request->assessment_name,
    'due_date' => $request->due_date,

    'questionnaire' => $request->questionnaire,
    'priority' => $request->priority,

    'assigned_by' => $request->assigned_by,
    'reviewer' => $request->reviewer,

    'status' => $request->status,
    'review_status' => $request->review_status,
]);
  $questions = Question::where(
    'category_id',
    $request->questionnaire
)->get();

foreach ($questions as $question) {

    AssessmentQuestion::create([
        'assessment_id' => $assessment->id,
        'question_id' => $question->id
    ]);

}

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

    return view(
        'assessments.show',
        compact(
            'assessment',
            'riskScore',
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
}
