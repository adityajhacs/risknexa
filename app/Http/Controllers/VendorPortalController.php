<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assessment;
use App\Models\AssessmentResponse;

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
    {
        $vendor = auth()->user()->vendor;

        if ($assessment->vendor_id != $vendor->id) {
            abort(403);
        }

        $questions = $assessment
            ->questions()
            ->distinct()
            ->get();

        return view(
            'vendor.assessment-details',
            compact('assessment', 'questions')
        );
    }

    public function saveResponses(
    Request $request,
    Assessment $assessment
)
{
    foreach ($request->answers as $questionId => $answer)
    {
        $filePath = null;

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
        $assessment->update([
            'status' => 'Submitted'
        ]);

        return redirect()
            ->route('my.assessments')
            ->with(
                'success',
                'Assessment submitted successfully.'
            );
    }
}