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
public function saveReview(Request $request, Assessment $assessment)
{
    if (auth()->user()->role != 'reviewer') {
        abort(403);
    }

    if ($assessment->reviewer != auth()->user()->name) {
        abort(403);
    }

    $request->validate([
        'questions' => 'required|array'
    ]);

    $totalScore = 0;

    foreach ($request->questions as $id => $data) {

        $assessmentQuestion = $assessment->assessmentQuestions()
            ->where('id', $id)
            ->first();

        if (!$assessmentQuestion) {
            continue;
        }

        $assessmentQuestion->update([
            'score' => $data['score'] ?? 0,
            'reviewer_comment' => $data['comment'] ?? null,
        ]);

        $totalScore += $data['score'] ?? 0;
    }

    $assessment->risk_score = $totalScore;

    if ($totalScore >= 80) {
        $assessment->risk_level = 'Low';
    } elseif ($totalScore >= 50) {
        $assessment->risk_level = 'Medium';
    } else {
        $assessment->risk_level = 'High';
    }

    $assessment->review_status = 'Reviewed';

    $assessment->save();

    return redirect()
        ->route('reviewer.dashboard')
        ->with('success', 'Assessment reviewed successfully.');
}
public function assessmentOverview(Assessment $assessment)
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
        'assessmentQuestions.question.domain'
    ]);

    $domains = $assessment->assessmentQuestions
        ->groupBy(function ($item) {
            return $item->question->domain->id;
        });

    return view(
        'reviewers.assessment-overview',
        compact('assessment', 'domains')
    );
}
}