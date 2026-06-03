<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assessment;
use App\Models\Question;
use App\Models\AssessmentQuestion;
use App\Services\RiskScoringService;

class AssessmentQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $assessmentQuestions = AssessmentQuestion::with([
        'assessment',
        'question'
    ])->get();

    return view(
        'assessment_questions.index',
        compact('assessmentQuestions')
    );
}

    /**
     * Show the form for creating a new resource.
     */
   public function create()
{
    $assessments = Assessment::all();
    $questions = Question::all();

    return view(
        'assessment_questions.create',
        compact('assessments', 'questions')
    );
}

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
  $riskService = new RiskScoringService();
   $score = $riskService->calculateScore(
    $request->response
);
    

    AssessmentQuestion::create([
        'assessment_id' => $request->assessment_id,
        'question_id' => $request->question_id,
        'response' => $request->response,
        'score' => $score
    ]);

    // Total score calculate karo
    $totalScore = AssessmentQuestion::where(
        'assessment_id',
        $request->assessment_id
    )->sum('score');

    // Risk level calculate karo
    if ($totalScore <= 20) {
        $riskLevel = 'Low';
    } elseif ($totalScore <= 50) {
        $riskLevel = 'Medium';
    } elseif ($totalScore <= 80) {
        $riskLevel = 'High';
    } else {
        $riskLevel = 'Critical';
    }

    // Assessment update karo
    Assessment::where(
        'id',
        $request->assessment_id
    )->update([
        'risk_score' => $totalScore,
        'risk_level' => $riskLevel
    ]);

    return redirect()->route('assessment-questions.index');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
