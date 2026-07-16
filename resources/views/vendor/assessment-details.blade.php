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
    id="questionForm{{ $index }}"
    method="POST"
    action="{{ route('vendor.assessments.saveQuestion', [$assessment->id, $question->id]) }}"
    enctype="multipart/form-data"
>
    @csrf
    <input
    type="hidden"
    name="next_question"
    id="nextQuestion{{ $index }}"
    value="{{ $index }}">
     <div
    class="bg-white rounded-2xl shadow-sm border border-slate-200 mb-4 overflow-hidden">

    <!-- Header -->

    <button
        type="button"
        onclick="toggleQuestion({{ $index }})"
        class="w-full flex justify-between items-center p-6 bg-gradient-to-r from-slate-50 to-slate-100 hover:from-blue-50 hover:to-indigo-50 transition">

        <div class="text-left">

           
            <div>

   <div class="flex items-center justify-between">

    <h3 class="font-semibold text-slate-800">

        Q{{ $index + 1 }}

    </h3>

    @php
        $response = $responses[$question->id] ?? null;
    @endphp

    @if($response && $response->answer)

        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
            ✅ Saved
        </span>

    @else

        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-700">
            Pending
        </span>

    @endif

</div>

<p class="text-sm text-slate-500 mt-2">

    {{ Str::limit($question->question,70) }}

</p>

</div>

        </div>

        <span id="icon{{ $index }}"
              class="text-2xl">

            {{ $currentQuestion == $index ? '-' : '+' }}

        </span>

    </button>

    <!-- Body -->

    <div
        id="body{{ $index }}"
        class="{{ $currentQuestion == $index ? '' : 'hidden' }} p-6 border-t">

           <label class="block text-sm font-semibold text-slate-700 mb-2">
    Implementation Narrative
</label>

               <textarea
               @if($assessment->status=='Submitted') readonly @endif
    name="answer"
    rows="4"
    class="w-full rounded-2xl border border-slate-300 bg-slate-50 p-4 focus:border-blue-500 focus:ring-2 focus:ring-blue-300"
    placeholder="Enter your response..."
>{{ $responses[$question->id]->answer ?? '' }}</textarea>
           
           <p class="text-sm font-medium text-slate-600 mb-2">
    Upload Evidence
</p>
           <input
type="file"
@if($assessment->status=='Submitted') disabled @endif 
                name="evidence"
                class="mt-4 block w-full rounded-xl border border-dashed border-blue-300 bg-blue-50 p-4"
            >
            
            <p class="text-xs text-red-500">
    {{ $responses[$question->id]->evidence_file ?? 'NO FILE' }}
</p>
         @if(isset($responses[$question->id]) && $responses[$question->id]->evidence_file)

<p class="mt-2 text-sm font-medium text-green-600">
    Evidence Uploaded ✅
</p>

@endif
<div class="flex justify-between mt-6">

    @if($index > 0)
        <button
            type="button"
            onclick="toggleQuestion({{ $index-1 }})"
            class="px-5 py-2 rounded-lg bg-gray-200 hover:bg-gray-300">
            Previous
        </button>
    @else
        <div></div>
    @endif

    <div class="flex gap-3">

        <button
        @if($assessment->status=='Submitted') disabled @endif
            type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">
            Save
        </button>

        @if($index < $questions->count()-1)

           <button
    type="button"
    @if($assessment->status=='Submitted') disabled @endif
    onclick="saveAndNext({{ $index }})"
    class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg">
    Save & Next
</button>

        @else

        @if($assessment->status != 'Submitted')

<form method="POST"
      action="{{ route('vendor.assessments.submit',$assessment->id) }}">

    @csrf

    <button
        type="submit"
        class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg">

        Submit Assessment

    </button>

</form>

@else

<span class="px-4 py-2 rounded-lg bg-green-100 text-green-700 font-semibold">

    Assessment Submitted ✅

</span>

@endif
        @endif

    </div>

</div>
            </div>   {{-- body close --}}

</div>       {{-- accordion card close --}}

</form>
        @endforeach

      
           
       


<script>

function toggleQuestion(index){

    let total = {{ $questions->count() }};

    for(let i = 0; i < total; i++){

        document.getElementById('body'+i).classList.add('hidden');
        document.getElementById('icon'+i).innerHTML = '+';

    }

    document.getElementById('body'+index).classList.remove('hidden');
    document.getElementById('icon'+index).innerHTML = '-';

    window.scrollTo({
        top: document.getElementById('body'+index).offsetTop-120,
        behavior:'smooth'
    });

}

// 👇 YE NAYA FUNCTION ADD KARNA HAI
function saveAndNext(index){

    // Agla question number set karo
    document.getElementById('nextQuestion'+index).value = index + 1;

    // Form submit karo
    document.getElementById('questionForm'+index).submit();

}

</script>

@endsection