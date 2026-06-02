<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Category;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = Question::with('category')->get();

    return view('questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

    return view('questions.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Question::create([
        'category_id' => $request->category_id,
        'question' => $request->question,
        'risk_weight' => $request->risk_weight,
        'status' => $request->status,
    ]);

    return redirect()->route('questions.index');
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
