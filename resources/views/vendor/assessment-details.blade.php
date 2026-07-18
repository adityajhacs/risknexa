@extends('layouts.vendor')

@section('content')

<div class="max-w-7xl mx-auto p-6">

    {{-- Hero Section --}}

    <div class="bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-700 rounded-3xl p-8 text-white shadow-lg mb-8">

        <p class="uppercase tracking-widest text-xs opacity-80">

            Vendor Assessment Portal

        </p>

        <h1 class="text-4xl font-bold mt-2">

            {{ $assessment->assessment_name }}

        </h1>

        <p class="mt-3 text-blue-100">

            Complete all assigned controls and upload supporting compliance evidence.

        </p>

    </div>



    {{-- Progress Card --}}

    <div class="bg-white rounded-2xl shadow-sm border p-6 mb-8">

        <div class="flex justify-between items-center">

            <h2 class="font-bold text-lg">

                Assessment Progress

            </h2>

            <span class="font-bold text-blue-600 text-lg">

                {{ $progress }}%

            </span>

        </div>

        <div class="mt-5 h-5 bg-slate-200 rounded-full overflow-hidden">

            <div
                class="h-5 bg-gradient-to-r from-blue-500 to-indigo-600"
                style="width:{{ $progress }}%">
            </div>

        </div>

        <div class="flex justify-between mt-4 text-sm text-slate-500">

            <span>

                {{ $answeredQuestions }}
                /
                {{ $totalQuestions }}
                Questions Completed

            </span>

            <span>

                {{ $totalQuestions-$answeredQuestions }}
                Remaining

            </span>

        </div>

    </div>



    {{-- Summary Cards --}}

    <div class="grid md:grid-cols-4 gap-6 mb-8">

        <div class="bg-white rounded-2xl shadow-sm border p-6">

            <p class="text-slate-500">

                Status

            </p>

            <h2 class="text-2xl font-bold text-green-600 mt-2">

                {{ $assessment->status }}

            </h2>

        </div>

        <div class="bg-white rounded-2xl shadow-sm border p-6">

            <p class="text-slate-500">

                Questions

            </p>

            <h2 class="text-2xl font-bold text-blue-600 mt-2">

                {{ $questions->count() }}

            </h2>

        </div>

        <div class="bg-white rounded-2xl shadow-sm border p-6">

            <p class="text-slate-500">

                Risk Level

            </p>

            <h2 class="text-2xl font-bold text-red-600 mt-2">

                {{ $assessment->risk_level ?? 'Pending' }}

            </h2>

        </div>

        <div class="bg-white rounded-2xl shadow-sm border p-6">

            <p class="text-slate-500">

                Due Date

            </p>

            <h2 class="text-2xl font-bold mt-2">

                {{ \Carbon\Carbon::parse($assessment->due_date)->format('d M Y') }}

            </h2>

        </div>

    </div>



    {{-- Main Layout --}}

    <div class="grid grid-cols-12 gap-6">



        {{-- ===========================
             LEFT SIDEBAR
        ============================ --}}

        <div class="col-span-3">

            <div class="bg-white rounded-2xl shadow-sm border overflow-hidden sticky top-5">

                <div class="p-5 border-b">

                    <h2 class="font-bold text-lg">

                        Assessment Domains

                    </h2>

                </div>

                @foreach($domains as $domainName => $domainQuestions)

                    <button

                        id="tab{{ $loop->index }}"

                        onclick="showDomain({{ $loop->index }})"

                        type="button"

                        class="w-full text-left px-5 py-4 border-b hover:bg-slate-50 transition

                        {{ $loop->first ? 'bg-blue-50 text-blue-700 font-semibold' : '' }}">

                        <div class="flex justify-between items-center">

                            <span>

                                {{ $domainName }}

                            </span>

                            <span class="bg-slate-100 rounded-full px-3 py-1 text-xs">

                                {{ $domainQuestions->count() }}

                            </span>

                        </div>

                    </button>

                @endforeach

            </div>

        </div>



        {{-- ===========================
             RIGHT CONTENT START
        ============================ --}}

        <div class="col-span-9">

@php

$flatQuestions = $questions->values();

@endphp
{{-- ===========================
     RIGHT CONTENT
=========================== --}}

@foreach($domains as $domainName => $domainQuestions)

<div
    id="domain{{ $loop->index }}"
    class="{{ $loop->first ? '' : 'hidden' }}">

    {{-- Domain Header --}}

    <div class="bg-white rounded-2xl shadow-sm border p-6 mb-6">

        <div class="flex justify-between items-center">

            <div>

                <h2 class="text-2xl font-bold">

                    {{ $domainName }}

                </h2>

                <p class="text-slate-500 mt-1">

                    {{ $domainQuestions->count() }}
                    Controls

                </p>

            </div>

            <div>

                <span class="px-4 py-2 rounded-full bg-blue-100 text-blue-700 font-semibold">

                    Domain

                </span>

            </div>

        </div>

    </div>


    {{-- Questions --}}

    @foreach($domainQuestions as $question)

       @php

$response = $responses[$question->id] ?? null;


// current domain ke andar question ka index

$currentIndex = $domainQuestions->search(function($q) use ($question){

    return $q->id == $question->id;

});


// previous question same domain me

$previousQuestion = $currentIndex > 0
    ? $domainQuestions[$currentIndex - 1]
    : null;


// next question same domain me

$nextQuestion = $currentIndex < ($domainQuestions->count() - 1)
    ? $domainQuestions[$currentIndex + 1]
    : null;


@endphp


        <form

            id="questionForm{{ $question->id }}"

            method="POST"

            action="{{ route('vendor.assessments.saveQuestion',[$assessment->id,$question->id]) }}"

            enctype="multipart/form-data">

            @csrf
              
        <input
type="hidden"
name="next_question"
id="nextQuestion{{ $question->id }}"
value="">


           @php
    $isLastDomain = $loop->parent->last;
    $isLastQuestion = $loop->last;
@endphp

@include('vendor.partials.question-card')
        </form>

    @endforeach

</div>

@endforeach
<div class="mt-8 bg-white rounded-2xl shadow-sm border p-6">

    <div class="flex items-center justify-between">

        <div>

            <h2 class="text-xl font-bold">

                Assessment Completion

            </h2>

            <p class="text-slate-500 mt-1">

                Complete all questions before submitting the assessment.

            </p>

        </div>

        <form
            method="POST"
            action="{{ route('vendor.assessments.submit',$assessment->id) }}">

            @csrf

           <button
    type="button"
    onclick="openSubmitModal()"
    class="px-8 py-3 rounded-xl bg-indigo-600 text-white hover:bg-indigo-700"
    @if($assessment->status=='Submitted') disabled @endif>

    🚀 Submit Assessment

</button>

        </form>

    </div>

</div>

</div> {{-- right content --}}

</div> {{-- grid --}}
<form
    id="submitAssessmentForm"
    method="POST"
    action="{{ route('vendor.assessments.submit',$assessment->id) }}">

    @csrf

</form>
<div
    id="submitModal"
    class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6">

        <div class="text-center">

            <div class="text-5xl mb-4">
                ⚠️
            </div>

            <h2 class="text-2xl font-bold text-slate-800">

                Submit Assessment?

            </h2>

            <p class="mt-4 text-slate-600">

                Once submitted, this assessment will become
                <strong>read only</strong>.

                You won't be able to edit answers or upload evidence.

            </p>

        </div>

        <div class="flex justify-end gap-3 mt-8">

            <button
                type="button"
                onclick="closeSubmitModal()"
                class="px-5 py-2 rounded-xl border">

                Cancel

            </button>

            <button
                type="button"
                onclick="submitAssessment()"
                class="px-5 py-2 rounded-xl bg-indigo-600 text-white hover:bg-indigo-700">

                Yes, Submit

            </button>

        </div>

    </div>

</div>
<script>

let currentDomain = 0;

window.onload = function(){

    showDomain(0);

};



/* ==========================
   DOMAIN SWITCH
========================== */

function showDomain(index)
{
    currentDomain = index;

    document.querySelectorAll("[id^='domain']").forEach(function(el){

        el.classList.add("hidden");

    });

    document.querySelectorAll("[id^='tab']").forEach(function(el){

        el.classList.remove(
            "bg-blue-50",
            "text-blue-700",
            "font-semibold"
        );

    });

    document
        .getElementById("domain"+index)
        .classList.remove("hidden");

    document
        .getElementById("tab"+index)
        .classList.add(
            "bg-blue-50",
            "text-blue-700",
            "font-semibold"
        );



    /* First Question Automatically Open */

    let firstBody =
        document
            .getElementById("domain"+index)
            .querySelector("[id^='body']");

    if(firstBody)
    {

        document.querySelectorAll("[id^='body']").forEach(function(el){

            el.classList.add("hidden");

        });

        document.querySelectorAll("[id^='icon']").forEach(function(el){

            el.innerHTML='+';

        });

        firstBody.classList.remove("hidden");

        let id = firstBody.id.replace("body","");

        document
            .getElementById("icon"+id)
            .innerHTML='−';

    }

}



/* ==========================
   ACCORDION
========================== */

function toggleQuestion(id)
{

    let body =
        document.getElementById("body"+id);

    let icon =
        document.getElementById("icon"+id);



    if(body.classList.contains("hidden"))
    {

        body.classList.remove("hidden");

        icon.innerHTML="−";

    }
    else
    {

        body.classList.add("hidden");

        icon.innerHTML="+";

    }

}



/* ==========================
   SAVE & NEXT
========================== */

function saveAndNext(currentId,nextId)
{

    let form = document.getElementById(
        "questionForm"+currentId
    );


    let formData = new FormData(form);


    fetch(form.action, {

        method: "POST",

        body: formData,

        headers: {

            "X-CSRF-TOKEN":
            document.querySelector('input[name="_token"]').value

        }

    })
    .then(response => {

        if(response.ok)
        {

            openQuestion(nextId);

        }

    })
    .catch(error => {

        console.log(error);

    });

}



/* ==========================
   OPEN QUESTION
========================== */

function openQuestion(id)
{

    document.querySelectorAll("[id^='body']").forEach(function(el){

        el.classList.add("hidden");

    });

    document.querySelectorAll("[id^='icon']").forEach(function(el){

        el.innerHTML='+';

    });



    let body =
        document.getElementById("body"+id);

    if(body)
    {

        body.classList.remove("hidden");

        document
            .getElementById("icon"+id)
            .innerHTML='−';

        body.scrollIntoView({

            behavior:'smooth',

            block:'start'

        });

    }

}



/* ==========================
   INTELLIGENCE BOX
========================== */

function toggleIntelligence(id)
{

    let body =
        document.getElementById("intelBody"+id);

    let icon =
        document.getElementById("intelIcon"+id);

    if(body.classList.contains("hidden"))
    {

        body.classList.remove("hidden");

        icon.innerHTML="−";

    }
    else
    {

        body.classList.add("hidden");

        icon.innerHTML="+";

    }

}
function openSubmitModal()
{
    let modal = document.getElementById("submitModal");

    modal.classList.remove("hidden");
    modal.classList.add("flex");
}

function closeSubmitModal()
{
    let modal = document.getElementById("submitModal");

    modal.classList.remove("flex");
    modal.classList.add("hidden");
}

function submitAssessment()
{
    document
        .getElementById("submitAssessmentForm")
        .submit();
}

</script>

@endsection