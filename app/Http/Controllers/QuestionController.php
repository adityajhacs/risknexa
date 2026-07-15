<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Domain;


class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $questions = Question::with('domain.category')
                    ->latest()
                    ->paginate(10);

    return view('questions.index', compact('questions'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $domains = Domain::with('category')
                ->where('status', 'Active')
                ->orderBy('display_order')
                ->get();

    return view('questions.create', compact('domains'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([

        'domain_id' => 'required|exists:domains,id',

        'control_code' => 'nullable|max:100',

        'question' => 'required',

        'description' => 'nullable',

        'response_type' => 'required',

        'risk_weight' => 'required|integer|min:1|max:10',

        'risk_level' => 'required',

        'status' => 'required',

    ]);
    $domain = Domain::with('category')->findOrFail($request->domain_id);

    Question::create([
        'category_id' => $domain->category_id,

        'domain_id' => $request->domain_id,

        'control_code' => $request->control_code,

        'question' => $request->question,

        'description' => $request->description,

        'response_type' => $request->response_type,

        'requires_explanation' => $request->has('is_required'),

        'evidence_mandatory' => $request->has('evidence_required'),

        'risk_weight' => $request->risk_weight,

        'risk_level' => $request->risk_level,

        'control_guidance' => $request->guidance,

        'display_order' => 1,

        'status' => $request->status,

    ]);

    return redirect()
            ->route('questions.index')
            ->with('success','Question Created Successfully');
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
    public function edit(Question $question)
{
    $categories = Category::all();

    return view('questions.edit', compact('question', 'categories'));
}

public function update(Request $request, Question $question)
{
    $request->validate([
    'category_id' => 'required',
    'question' => 'required',
    'risk_weight' => 'required|numeric|min:0|max:100',
    'status' => 'required'
]);
    $question->update([
        'category_id' => $request->category_id,
        'question' => $request->question,
        'risk_weight' => $request->risk_weight,
        'status' => $request->status,
    ]);

    return redirect()->route('questions.index');
}

public function destroy(Question $question)
{
    $question->delete();

    return redirect()->route('questions.index');
}
}
