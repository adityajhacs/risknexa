<?php

namespace App\Http\Controllers;
use App\Models\AssessmentResponseHistory;

use Illuminate\Http\Request;
use App\Models\Assessment;
use App\Models\AssessmentResponse;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Storage;
class VendorPortalController extends Controller
{
    public function index()
    { 
       $vendor = auth()->user()->vendor;

if (!$vendor)
{
    abort(403, 'Vendor profile not found.');
}

$assessments = Assessment::where(
    'vendor_id',
    $vendor->id
)->get();

        return view(
            'vendor.assessments',
            compact('assessments')
        );
    }

    public function show(Assessment $assessment)
{  $responses = AssessmentResponse::where(
    'assessment_id',
    $assessment->id
)->get()->keyBy('question_id');
    $vendor = auth()->user()->vendor;

    if ($assessment->vendor_id != $vendor->id) {
        abort(403);
    }

    $questions = $assessment->questions()->distinct()->get();


   return view(
    'vendor.assessment-details',
    compact('assessment', 'questions', 'responses')
);
}

   
  public function submitAssessment(
    Request $request,
    Assessment $assessment
)
{
    if ($assessment->status == 'Submitted') {

        return back()->with(
            'error',
            'Assessment already submitted.'
        );
    }

    $totalQuestions = $assessment
        ->questions()
        ->count();

    $answered = AssessmentResponse::where(
        'assessment_id',
        $assessment->id
    )
    ->whereNotNull('answer')
    ->where('answer', '!=', '')
    ->count();

    if ($answered != $totalQuestions) {

        return back()->with(
            'error',
            'Please answer all questions before submitting.'
        );
    }

    $assessment->update([
        'status' => 'Submitted'
    ]);

    ActivityLog::create([
        'user_id' => auth()->id(),
        'action' => 'assessment_submitted',
        'description' =>
            auth()->user()->name .
            ' submitted ' .
            $assessment->assessment_name
    ]);

    return redirect()
        ->route('my.assessments')
        ->with(
            'success',
            'Assessment submitted successfully.'
        );
}
public function saveQuestion(
    Request $request,
    Assessment $assessment,
    $question
)
{
    $request->validate([
        'answer' => 'nullable|string',
        'evidence' => 'nullable|file|max:10240'
    ]);

    $response = AssessmentResponse::firstOrNew([
        'assessment_id' => $assessment->id,
        'question_id'   => $question,
    ]);

    /*
    |--------------------------------------------------------------------------
    | Answer Updated
    |--------------------------------------------------------------------------
    */

    if ($response->answer != $request->answer)
    {
        AssessmentResponseHistory::create([

            'assessment_id' => $assessment->id,

            'question_id' => $question,

            'user_id' => auth()->id(),

            'type' => 'answer_updated',

            'old_answer' => $response->answer,

            'new_answer' => $request->answer,

        ]);

        $response->answer = $request->answer;

        $response->answer_updated_by = auth()->id();

        $response->answer_updated_at = now();
    }

    /*
    |--------------------------------------------------------------------------
    | Evidence Upload / Replace
    |--------------------------------------------------------------------------
    */

    if ($request->hasFile('evidence'))
    {
        $oldFile = $response->evidence_file;

        if (
            $response->exists &&
            $response->evidence_file &&
            Storage::disk('public')->exists($response->evidence_file)
        ) {
            Storage::disk('public')->delete($response->evidence_file);
        }

        $response->evidence_file = $request
            ->file('evidence')
            ->store('evidence', 'public');

        $response->evidence_uploaded_by = auth()->id();

        $response->evidence_uploaded_at = now();

        AssessmentResponseHistory::create([

            'assessment_id' => $assessment->id,

            'question_id' => $question,

            'user_id' => auth()->id(),

            'type' => 'evidence_uploaded',

            'old_file' => $oldFile,

            'new_file' => $response->evidence_file,

        ]);
    }

    $response->save();

    /*
    |--------------------------------------------------------------------------
    | Activity Log
    |--------------------------------------------------------------------------
    */

    ActivityLog::create([
        'user_id' => auth()->id(),
        'action' => 'question_saved',
        'description' =>
            auth()->user()->name .
            ' saved Question #' .
            $question .
            ' in ' .
            $assessment->assessment_name
    ]);

    if ($assessment->status == 'Assigned')
    {
        $assessment->update([
            'status' => 'In Progress'
        ]);
    }

    return back()->with(
        'success',
        'Question saved successfully.'
    );
}
public function deleteEvidence(
    Assessment $assessment,
    $question
)
{
    $response = AssessmentResponse::where(
        'assessment_id',
        $assessment->id
    )
    ->where(
        'question_id',
        $question
    )
    ->first();

    if (!$response)
    {
        return back()->with(
            'error',
            'Evidence not found.'
        );
    }

    $oldFile = $response->evidence_file;

    if (
        $response->evidence_file &&
        Storage::disk('public')->exists($response->evidence_file)
    ) {
        Storage::disk('public')->delete(
            $response->evidence_file
        );
    }

    $response->evidence_file = null;
    $response->evidence_uploaded_by = null;
    $response->evidence_uploaded_at = null;

    $response->save();

    /*
    |--------------------------------------------------------------------------
    | History
    |--------------------------------------------------------------------------
    */

    AssessmentResponseHistory::create([

        'assessment_id' => $assessment->id,

        'question_id' => $question,

        'user_id' => auth()->id(),

        'type' => 'evidence_deleted',

        'old_file' => $oldFile,

        'new_file' => null,

    ]);

    /*
    |--------------------------------------------------------------------------
    | Activity Log
    |--------------------------------------------------------------------------
    */

    ActivityLog::create([
        'user_id' => auth()->id(),
        'action' => 'evidence_deleted',
        'description' =>
            auth()->user()->name .
            ' deleted evidence of Question #' .
            $question .
            ' in ' .
            $assessment->assessment_name
    ]);

    return back()->with(
        'success',
        'Evidence deleted successfully.'
    );
}
public function history(
    Assessment $assessment,
    $question
)
{
    $history = AssessmentResponseHistory::where(
        'assessment_id',
        $assessment->id
    )
    ->where(
        'question_id',
        $question
    )
    ->latest()
    ->get();

    return view(
        'vendor.history',
        compact(
            'assessment',
            'history',
            'question'
        )
    );
}
}