<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assessment;
use App\Models\AssessmentResponse;
use App\Models\ActivityLog;

class VendorPortalController extends Controller
{
    public function index()
    {
        $vendor = auth()->user()->vendor;

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

   public function saveResponses(
    Request $request,
    Assessment $assessment
)
{
    foreach ($request->answers as $questionId => $answer)
    {
        $response = AssessmentResponse::where(
            'assessment_id',
            $assessment->id
        )
        ->where(
            'question_id',
            $questionId
        )
        ->first();

        $filePath = $response->evidence_file ?? null;

        if ($request->hasFile("evidence.$questionId"))
        {
            $filePath = $request
                ->file("evidence.$questionId")
                ->store('evidence', 'public');
        }

        AssessmentResponse::updateOrCreate(
            [
                'assessment_id' => $assessment->id,
                'question_id'   => $questionId,
            ],
            [
                'answer'        => $answer,
                'evidence_file' => $filePath,
            ]
        );
    }

    if ($assessment->status == 'Assigned')
    {
        $assessment->update([
            'status' => 'In Progress'
        ]);
    }

    ActivityLog::create([
        'user_id' => auth()->id(),
        'action' => 'response_saved',
        'description' => auth()->user()->name .
            ' saved assessment responses'
    ]);

    return back()->with(
        'success',
        'Responses saved successfully.'
    );
}

   public function submitAssessment(
    Request $request,
    Assessment $assessment
)
{
    foreach ($request->input('answers', []) as $answer)
    {
        if (trim($answer ?? '') == '')
        {
            return back()->with(
                'error',
                'Please answer all questions before submitting the assessment.'
            );
        }
    }

    $assessment->update([
        'status' => 'Submitted'
    ]);

    ActivityLog::create([
        'user_id' => auth()->id(),
        'action' => 'assessment_submitted',
        'description' => auth()->user()->name .
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
}