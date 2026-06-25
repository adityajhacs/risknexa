<?php

namespace App\Http\Controllers;

use App\Models\Assessment;

class VendorAssessmentController extends Controller
{
    public function show(Assessment $assessment)
    {
        $assessment->load('assessmentQuestions.question');

        return view(
            'vendor.assessment-show',
            compact('assessment')
        );
    }
}