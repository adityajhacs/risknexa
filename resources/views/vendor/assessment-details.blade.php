@extends('layouts.vendor')

@section('content')

<div class="max-w-7xl mx-auto p-6">

    <!-- Hero Section -->

    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white rounded-3xl p-8 mb-8">

        <p class="uppercase tracking-wider text-sm opacity-80">
            Vendor Assessment
        </p>

        <h1 class="text-4xl font-bold mt-2">
            {{ $assessment->assessment_name }}
        </h1>

        <p class="mt-3 text-blue-100">
            Complete all controls and upload supporting evidence.
        </p>

    </div>
   

    <div class="bg-white rounded-2xl shadow-sm p-6 mb-8">

   <div class="flex justify-between items-center mb-3">

    <span class="font-medium text-slate-700">
        Assessment Progress
    </span>

    <span class="font-bold text-blue-600">
        {{ $progress }}%
    </span>

</div>

<div class="w-full bg-slate-200 rounded-full h-5 overflow-hidden">

    <div
        class="bg-gradient-to-r from-blue-500 to-indigo-600 h-5 rounded-full transition-all duration-500"
        style="width: {{ $progress }}%;">
    </div>

</div>

<div class="flex justify-between mt-3 text-sm text-slate-500">

    <span>
        {{ $answeredQuestions }} of {{ $totalQuestions }} Questions Answered
    </span>

    <span>
        {{ $totalQuestions - $answeredQuestions }} Remaining
    </span>

</div>

</div>



    <!-- Assessment Info -->

<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

    <div class="bg-white rounded-2xl shadow-sm p-6">
        <p class="text-slate-500">Status</p>
        <h2 class="text-2xl font-bold text-green-600">
            {{ $assessment->status }}
        </h2>
    </div>

    <div class="bg-white rounded-2xl shadow-sm p-6">
        <p class="text-slate-500">Questions</p>
        <h2 class="text-2xl font-bold text-blue-600">
            {{ $questions->count() }}
        </h2>
    </div>

    <div class="bg-white rounded-2xl shadow-sm p-6">
        <p class="text-slate-500">Risk Level</p>
        <h2 class="text-2xl font-bold text-red-600">
            {{ $assessment->risk_level ?? 'Pending' }}
        </h2>
    </div>

    <div class="bg-white rounded-2xl shadow-sm p-6">
        <p class="text-slate-500">Due Date</p>
        <h2 class="text-2xl font-bold">
            {{ \Carbon\Carbon::parse($assessment->due_date)->format('d M Y') }}
        </h2>
    </div>

</div>
    

    <!-- Form -->
    
        @foreach($questions as $index => $question)
        <form
    method="POST"
    action="{{ route('vendor.assessments.saveQuestion', [$assessment->id, $question->id]) }}"
    enctype="multipart/form-data"
>
    @csrf

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mb-6">

            <h3 class="font-semibold text-lg text-slate-800 mb-4">
    Question {{ $index + 1 }}
</h3>

<p class="text-slate-700 mb-4">
    {{ $question->question }}
</p>
               <textarea
    name="answers[{{ $question->id }}]"
    rows="4"
    class="w-full border border-slate-300 rounded-xl p-4 focus:ring-2 focus:ring-blue-500"
    placeholder="Enter your response..."
>{{ $responses[$question->id]->answer ?? '' }}</textarea>
           
           <p class="text-sm font-medium text-slate-600 mb-2">
    Upload Evidence
</p>
            <input
                type="file"
                name="evidence[{{ $question->id }}]"
                class="mt-4 block w-full border border-slate-300 rounded-xl p-3"
            >
            
            <p class="text-xs text-red-500">
    {{ $responses[$question->id]->evidence_file ?? 'NO FILE' }}
</p>
         @if(isset($responses[$question->id]) && $responses[$question->id]->evidence_file)

<p class="mt-2 text-sm font-medium text-green-600">
    Evidence Uploaded ✅
</p>

@endif
        </div>
         </form>
        @endforeach

      
           
       

</div>
<div class="flex justify-end mt-4">

    <button
        type="submit"
        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg"
    >
        Save Question
    </button>

</div>

</form>

@endsection