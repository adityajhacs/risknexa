<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assessment;
use App\Models\Vendor;
use App\Models\Category;
use App\Models\Question;
use App\Models\AssessmentQuestion;
use App\Models\ActivityLog;
class AssessmentController extends Controller
{    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $assessments = Assessment::with(
    'vendor',
    'framework'
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
    $vendors = Vendor::where('status', 'Active')->get();

    $frameworks = \App\Models\Framework::where('status', 'Active')
                    ->orderBy('name')
                    ->get();
   

    return view(
        'assessments.create',
        compact(
            'vendors',
            'frameworks'
        )
    );
}

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $request->validate([

        'assessment_name' => 'required|max:255',
        'framework_id' => 'required|exists:frameworks,id',
        'vendor_id' => 'required|exists:vendors,id',
        'priority' => 'required',
        'due_date' => 'required|date',
        'description' => 'nullable',

    ]);

    // Create Assessment
    $assessment = Assessment::create([

        'assessment_name' => $request->assessment_name,
        'framework_id' => $request->framework_id,
        'vendor_id' => $request->vendor_id,
        'description' => $request->description,
        'priority' => $request->priority,
        'due_date' => $request->due_date,
        'status' => 'Pending',
        'review_status' => 'Pending Review',
        'assigned_by' => auth()->user()->name,
        'created_by' => auth()->id(),

    ]);

    // Get Questions of Selected Framework
    $questions = Question::whereHas('domain', function ($domain) use ($request) {

        $domain->whereHas('category', function ($category) use ($request) {

            $category->where('framework_id', $request->framework_id);

        });

    })->get();

   
    // Create Assessment Questions
    foreach ($questions as $question) {

        AssessmentQuestion::create([
            'assessment_id' => $assessment->id,
            'question_id' => $question->id,
        ]);

    }

    return redirect()
    ->route('assessments.index')
    ->with('success', 'Assessment Created Successfully');
}

    /**
     * Display the specified resource.
     */
  public function show(Assessment $assessment)
{$assessment->load([
    'vendor',
    'framework.categories.domains.questions',
    'responses.question',
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
$activities = ActivityLog::latest()
    ->take(10)
    ->get();
    return view(
        'assessments.show',
        compact(
            'assessment',
            'riskScore',
            'answeredQuestions',
'totalQuestions',
'evidenceCount',
            'riskLevel',
            'activities'
        )
    );
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Assessment $assessment)
    {
     $vendors = Vendor::all();

$frameworks = \App\Models\Framework::all();

return view(
    'assessments.edit',
    compact(
        'assessment',
        'vendors',
        'frameworks'
    )
);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Assessment $assessment)
{
    $request->validate([

        'assessment_name' => 'required|max:255',
        'framework_id' => 'required|exists:frameworks,id',
        'vendor_id' => 'required|exists:vendors,id',
        'priority' => 'required',
        'due_date' => 'required|date',
        'description' => 'nullable',

    ]);

    // Check whether framework changed
    $frameworkChanged = $assessment->framework_id != $request->framework_id;

    // Update Assessment
    $assessment->update([

        'assessment_name' => $request->assessment_name,
        'framework_id'    => $request->framework_id,
        'vendor_id'       => $request->vendor_id,
        'description'     => $request->description,
        'priority'        => $request->priority,
        'due_date'        => $request->due_date,
        'status'          => $request->status,

    ]);

    // If framework changed then regenerate questions
    if ($frameworkChanged) {

        // Delete old assigned questions
        AssessmentQuestion::where(
            'assessment_id',
            $assessment->id
        )->delete();

        // Get new framework questions
        $questions = Question::whereHas('domain', function ($domain) use ($request) {

            $domain->whereHas('category', function ($category) use ($request) {

                $category->where(
                    'framework_id',
                    $request->framework_id
                );

            });

        })->get();

        // Assign new questions
        foreach ($questions as $question) {

            AssessmentQuestion::create([

                'assessment_id' => $assessment->id,
                'question_id'   => $question->id,

            ]);

        }

    }

    return redirect()
        ->route('assessments.index')
        ->with('success', 'Assessment Updated Successfully');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Assessment $assessment)
    {
        
    $assessment->delete();

    return redirect('/assessments');

    }

public function report(Assessment $assessment)
{
    $questionResponses = $assessment
    ->assessmentQuestions()
    ->with('question')
    ->get();
   $totalQuestions = $assessment
        ->assessmentQuestions
        ->count();

    $answeredQuestions = $assessment
        ->assessmentQuestions
        ->whereNotNull('response')
        ->count();

    $evidenceCount = $assessment
        ->evidenceUploads
        ->count();
    $recommendation = match($assessment->risk_level) {

    'Low' => 'Approved',

    'Medium' => 'Approved with Conditions',

    'High' => 'Remediation Required',

    'Critical' => 'Reject Vendor',

    default => 'Pending'
};

    return view(
        'assessments.report',
        compact(
            'assessment',
            'totalQuestions',
            'answeredQuestions',
            'evidenceCount',
            'questionResponses',
            'recommendation'
        
        )
    );
}
public function reports()
{
if(auth()->user()->role != 'company_admin')
{
    abort(403);
}

$assessments = Assessment::with('vendor')->get();

$totalReports = $assessments->count();

$approvedReports = Assessment::where(
    'review_status',
    'Approved'
)->count();

$pendingReports = Assessment::where(
    'review_status',
    'Pending Review'
)->count();

$highRiskReports = Assessment::where(
    'risk_level',
    'High'
)->count();

return view(
    'reports.index',
    compact(
        'assessments',
        'totalReports',
        'approvedReports',
        'pendingReports',
        'highRiskReports'
    )
);
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

public function test()
{
    dd('Assessment Controller Working');
}
}
