<?php

namespace App\Http\Controllers;
use App\Models\AssessmentResponseHistory;
use App\Models\AssessmentQuestion;
use Illuminate\Http\Request;
use App\Models\Assessment;
use App\Models\AssessmentResponse;
use App\Models\ActivityLog;
use App\Models\Question;
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
{
    $vendor = auth()->user()->vendor;

    if (!$vendor || $assessment->vendor_id != $vendor->id) {
        abort(403);
    }

    /*
    |--------------------------------------------------------------------------
    | Responses
    |--------------------------------------------------------------------------
    */

    $responses = AssessmentResponse::where(
        'assessment_id',
        $assessment->id
    )->get()->keyBy('question_id');

    /*
    |--------------------------------------------------------------------------
    | Questions
    |--------------------------------------------------------------------------
    */

    $questions = $assessment->questions()
        ->with([
            'domain',
            'category'
        ])
        ->orderBy('display_order')
        ->get();

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

    $answeredQuestions = 0;

    foreach ($questions as $question) {

        $response = $responses[$question->id] ?? null;

        if (
            $response &&
            !empty(trim($response->answer ?? '')) &&
            !empty($response->implementation_status)
        ) {

            $answeredQuestions++;

        }
    }

    $progress = $totalQuestions > 0
        ? round(($answeredQuestions / $totalQuestions) * 100)
        : 0;

    /*
    |--------------------------------------------------------------------------
    | Domains
    |--------------------------------------------------------------------------
    */

    $domains = $questions->groupBy(function ($question) {

        return optional($question->domain)->name ?? 'General';

    });

    $domainKeys = $domains
        ->keys()
        ->values();

    /*
    |--------------------------------------------------------------------------
    | First Unanswered Question
    |--------------------------------------------------------------------------
    */

    $firstUnansweredQuestion = null;

    foreach ($questions as $question) {

        $response = $responses[$question->id] ?? null;

        if (
            !$response ||
            empty(trim($response->answer ?? '')) ||
            empty($response->implementation_status)
        ) {

            $firstUnansweredQuestion = $question->id;

            break;

        }

    }

    /*
    |--------------------------------------------------------------------------
    | Current Question
    |--------------------------------------------------------------------------
    */

    $currentQuestionId = request()->get('question');

    if ($currentQuestionId) {

        $currentQuestion = $questions->search(function ($question) use ($currentQuestionId) {

            return $question->id == $currentQuestionId;

        });

        if ($currentQuestion === false) {

            $currentQuestion = 0;

        }

    } else {

        if ($firstUnansweredQuestion) {

            $currentQuestion = $questions->search(function ($question) use ($firstUnansweredQuestion) {

                return $question->id == $firstUnansweredQuestion;

            });

            if ($currentQuestion === false) {

                $currentQuestion = 0;

            }

        } else {

            $currentQuestion = 0;

        }

    }

    /*
    |--------------------------------------------------------------------------
    | View
    |--------------------------------------------------------------------------
    */

    return view(
        'vendor.assessment-details',
        compact(
            'assessment',
            'questions',
            'responses',
            'domains',
            'domainKeys',
            'questionIds',
            'totalQuestions',
            'answeredQuestions',
            'progress',
            'currentQuestion',
            'firstUnansweredQuestion'
        )
    );
}

   
 public function submitAssessment(Assessment $assessment)
{
    $vendor = auth()->user()->vendor;

    if (!$vendor || $assessment->vendor_id != $vendor->id) {
        abort(403);
    }

    $questions = $assessment->questions()->get();

    $responses = AssessmentResponse::where(
        'assessment_id',
        $assessment->id
    )->get()->keyBy('question_id');

    $missingQuestions = [];

    foreach ($questions as $question) {

        $response = $responses[$question->id] ?? null;

        if (
            !$response ||
            empty(trim($response->answer ?? '')) ||
            empty($response->implementation_status)
        ) {

            $missingQuestions[] = $question->id;

        }
    }

    if (count($missingQuestions) > 0) {

        return redirect()
            ->route(
                'vendor.assessments.show',
                [
                    $assessment->id,
                    'question' => $missingQuestions[0]
                ]
            )
            ->with(
                'error',
                'Please complete all questions before submitting the assessment.'
            );
    }

    $assessment->update([

        'status' => 'Submitted',

        'submitted_at' => now()

    ]);

    ActivityLog::create([

        'user_id' => auth()->id(),

        'action' => 'assessment_submitted',

        'description' =>
            auth()->user()->name .
            ' submitted assessment "' .
            $assessment->assessment_name .
            '"'

    ]);

    return redirect()
        ->route(
            'vendor.assessments.show',
            $assessment->id
        )
        ->with(
            'success',
            'Assessment submitted successfully.'
        );
}
public function saveQuestion(
    Request $request,
    Assessment $assessment,
    Question $question
)
{
    /*
    |--------------------------------------------------------------------------
    | Authorization
    |--------------------------------------------------------------------------
    */

    $vendor = auth()->user()->vendor;

    if (!$vendor || $assessment->vendor_id != $vendor->id) {
        abort(403);
    }

    /*
    |--------------------------------------------------------------------------
    | Validation
    |--------------------------------------------------------------------------
    */

    $request->validate([

        'implementation_status' => 'nullable|in:Implemented,Partially Implemented,Planned,Not Implemented,Not Applicable',

        'answer' => 'nullable|string',

        'evidence' => 'nullable|file|max:10240'

    ]);
    

    /*
    |--------------------------------------------------------------------------
    | Response
    |--------------------------------------------------------------------------
    */

    $response = AssessmentResponse::firstOrNew([

        'assessment_id' => $assessment->id,

        'question_id' => $question->id

    ]);

    /*
    |--------------------------------------------------------------------------
    | Implementation Status
    |--------------------------------------------------------------------------
    */

    

    /*
    |--------------------------------------------------------------------------
    | Narrative
    |--------------------------------------------------------------------------
    */
    if ($response->implementation_status != $request->implementation_status)
{
    AssessmentResponseHistory::create([

        'assessment_id' => $assessment->id,

        'question_id' => $question->id,

        'user_id' => auth()->id(),

        'type' => 'implementation_status_updated',

        'old_answer' => $response->implementation_status,

        'new_answer' => $request->implementation_status,

    ]);
    $response->implementation_status =
        $request->implementation_status;
}
    if ($response->answer != $request->answer)
    {

        AssessmentResponseHistory::create([

            'assessment_id' => $assessment->id,

            'question_id' => $question->id,

            'user_id' => auth()->id(),

            'type' => 'answer_updated',

            'old_answer' => $response->answer,

            'new_answer' => $request->answer

        ]);

        $response->answer = $request->answer;

        $response->answer_updated_by = auth()->id();

        $response->answer_updated_at = now();

    }

    /*
    |--------------------------------------------------------------------------
    | Evidence Upload
    |--------------------------------------------------------------------------
    */

    if ($request->hasFile('evidence'))
    {
        $oldFile = $response->evidence_file;

        if (

            $response->exists &&

            $response->evidence_file &&

            Storage::disk('public')->exists(
                $response->evidence_file
            )

        )
        {
            Storage::disk('public')->delete(
                $response->evidence_file
            );
        }

        $response->evidence_file =
            $request
                ->file('evidence')
                ->store(
                    'assessment-evidence',
                    'public'
                );

        $response->evidence_uploaded_by =
            auth()->id();

        $response->evidence_uploaded_at =
            now();

        AssessmentResponseHistory::create([

            'assessment_id' => $assessment->id,

            'question_id' => $question->id,

            'user_id' => auth()->id(),

            'type' => 'evidence_uploaded',

            'old_file' => $oldFile,

            'new_file' => $response->evidence_file

        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Save
    |--------------------------------------------------------------------------
    */

    $response->save();
    
    /*
    |--------------------------------------------------------------------------
    | Activity Log
    |--------------------------------------------------------------------------
    */

    ActivityLog::create([

        'user_id' => auth()->id(),

        'action' => 'assessment_question_saved',

        'description' =>
            auth()->user()->name .
            ' updated Question #' .
            $question->id .
            ' of "' .
            $assessment->assessment_name .
            '"'

    ]);

    /*
    |--------------------------------------------------------------------------
    | Assessment Status
    |--------------------------------------------------------------------------
    */

    if ($assessment->status == 'Assigned')
    {
        $assessment->update([

            'status' => 'In Progress'

        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Save & Next
    |--------------------------------------------------------------------------
    */

   $nextQuestion = $request->next_question;


/*
|--------------------------------------------------------------------------
| Save Response
|--------------------------------------------------------------------------
*/

$response->save();



/*
|--------------------------------------------------------------------------
| AJAX Save & Next
|--------------------------------------------------------------------------
*/

if($request->ajax())
{
    return response()->json([
        'success'=>true
    ]);
}



/*
|--------------------------------------------------------------------------
| Normal Save
|--------------------------------------------------------------------------
*/

if ($nextQuestion) {

    return redirect()->route(
        'vendor.assessments.show',
        [
            $assessment->id,
            'question'=>$nextQuestion
        ]
    )->with(
        'success',
        'Question saved successfully.'
    );

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
    $history = AssessmentResponseHistory::where('assessment_id',$assessment->id)
        ->where('question_id',$question)
        ->with('user')
        ->latest()
        ->get();


    $questionData = Question::findOrFail($question);


    return view('vendor.history',[
        'assessment'=>$assessment,
        'history'=>$history,
        'question'=>$questionData
    ]);
}
}