<?php

namespace App\Http\Controllers;
use App\Models\AssessmentQuestion;
use Illuminate\Http\Request;
use App\Models\Assessment;
use App\Models\AssessmentResponse;
class ReviewerDashboardController extends Controller
{
   public function index()
{
    if (auth()->user()->role != 'reviewer') {
        abort(403);
    }

    $assessments = Assessment::with([
        'vendor',
        'framework',
        'questions',
        'responses'
    ])
    ->where('reviewer', auth()->user()->name)
    ->get();

    // Dashboard Stats
    $assignedAssessments = $assessments->count();

    $totalResponses = AssessmentResponse::whereHas('assessment', function ($q) {
        $q->where('reviewer', auth()->user()->name);
    })->count();

    $reviewedResponses = AssessmentResponse::whereHas('assessment', function ($q) {
        $q->where('reviewer', auth()->user()->name);
    })
    ->whereNotNull('review_status')
    ->count();

    $completedAssessments = $assessments
        ->where('review_status', 'Reviewed')
        ->count();

    return view('reviewers.dashboard', compact(
        'assessments',
        'assignedAssessments',
        'totalResponses',
        'reviewedResponses',
        'completedAssessments'
    ));
}
  public function review(Assessment $assessment)
{
    /*
    |--------------------------------------------------------------------------
    | Authorization
    |--------------------------------------------------------------------------
    */

    if(auth()->user()->role != 'reviewer')
    {
        abort(403);
    }

    /*
    |--------------------------------------------------------------------------
    | Load Assessment
    |--------------------------------------------------------------------------
    */

    $assessment->load([
        'vendor',
        'framework'
    ]);

    /*
    |--------------------------------------------------------------------------
    | Questions
    |--------------------------------------------------------------------------
    */

    $questions = $assessment
        ->questions()
        ->with([
            'domain',
            'category'
        ])
        ->orderBy('display_order')
        ->get();

    /*
    |--------------------------------------------------------------------------
    | Vendor Responses
    |--------------------------------------------------------------------------
    */

    $responses = AssessmentResponse::where(
        'assessment_id',
        $assessment->id
    )->get()->keyBy('question_id');

    /*
    |--------------------------------------------------------------------------
    | Domains
    |--------------------------------------------------------------------------
    */

    $domains = $questions->groupBy(function ($question) {

        return optional($question->domain)->name ?? 'General';

    });

    /*
    |--------------------------------------------------------------------------
    | Navigation
    |--------------------------------------------------------------------------
    */

    $questionIds = $questions
        ->pluck('id')
        ->values()
        ->toArray();

    /*
    |--------------------------------------------------------------------------
    | Progress
    |--------------------------------------------------------------------------
    */

    $totalQuestions = $questions->count();

    $reviewedQuestions = $responses
        ->filter(function ($response) {

            return !empty($response->review_status);

        })
        ->count();

    $progress = $totalQuestions > 0
        ? round(($reviewedQuestions / $totalQuestions) * 100)
        : 0;

    /*
    |--------------------------------------------------------------------------
    | Current Question
    |--------------------------------------------------------------------------
    */

    $currentQuestion = request()->get('question');

    if(!$currentQuestion)
    {
        $currentQuestion = $questionIds[0] ?? null;
    }

    /*
    |--------------------------------------------------------------------------
    | Current Domain
    |--------------------------------------------------------------------------
    */

    $currentDomain = request()->get('domain',0);

    /*
    |--------------------------------------------------------------------------
    | View
    |--------------------------------------------------------------------------
    */

    return view(
        'reviewers.review',
        compact(
            'assessment',
            'questions',
            'responses',
            'domains',
            'questionIds',
            'currentQuestion',
            'currentDomain',
            'totalQuestions',
            'reviewedQuestions',
            'progress'
        )
    );
}
public function saveReview(Request $request, Assessment $assessment)
{
    /*
    |--------------------------------------------------------------------------
    | Authorization
    |--------------------------------------------------------------------------
    */

    if (auth()->user()->role != 'reviewer') {
        abort(403);
    }

    /*
    |--------------------------------------------------------------------------
    | Save Review Against Assessment Responses
    |--------------------------------------------------------------------------
    */

    foreach ($assessment->questions as $question) {

        $response = AssessmentResponse::firstOrCreate(
            [
                'assessment_id' => $assessment->id,
                'question_id'   => $question->id,
            ]
        );

        $response->update([

            'review_comment'  => $request->comments[$question->id] ?? null,

            'review_decision' => $request->decision[$question->id] ?? null,

            'review_score'    => $request->score[$question->id] ?? null,

            'review_status'   => !empty($request->decision[$question->id])
                                    ? 'Reviewed'
                                    : 'Pending Review',

            'reviewed_by'     => auth()->id(),

            'reviewed_at'     => now(),

        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Update Assessment Review Status
    |--------------------------------------------------------------------------
    */

    $total = AssessmentResponse::where(
        'assessment_id',
        $assessment->id
    )->count();

    $reviewed = AssessmentResponse::where(
        'assessment_id',
        $assessment->id
    )->whereNotNull('review_decision')->count();

    $assessment->update([

        'review_status' => ($total > 0 && $total == $reviewed)
            ? 'Reviewed'
            : 'In Review',

    ]);

    return back()->with(
        'success',
        'Review saved successfully.'
    );
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