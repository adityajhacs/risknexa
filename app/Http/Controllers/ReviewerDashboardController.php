<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assessment;

class ReviewerDashboardController extends Controller
{
    public function index()
    {
        if(auth()->user()->role != 'reviewer')
        {
            abort(403);
        }

        $assessments = Assessment::where(
            'reviewer',
            auth()->user()->name
        )->get();

        return view(
            'reviewers.dashboard',
            compact('assessments')
        );
    }
    public function review(Assessment $assessment)
{
    if(auth()->user()->role != 'reviewer')
    {
        abort(403);
    }

    if($assessment->reviewer != auth()->user()->name)
    {
        abort(403);
    }

    $assessment->load([
        'vendor',
        'framework',
        'assessmentQuestions.question',
        'evidenceUploads'
    ]);

    return view(
        'reviewers.review',
        compact('assessment')
    );
}
}