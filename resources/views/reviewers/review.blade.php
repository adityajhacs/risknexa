@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto p-6">

    {{-- ===========================
        Header
    ============================ --}}
    @include('reviewers.partials.header')
    @php

$domains = $questions->groupBy(function($question){

    return optional($question->domain)->name ?? 'General';

});

@endphp

    {{-- ===========================
        Main Layout
    ============================ --}}
    <div class="grid grid-cols-12 gap-6 mt-6">

        {{-- Sidebar --}}
        <div class="col-span-3">

            @include('reviewers.partials.sidebar')

        </div>
          

        {{-- Question Panel --}}
       <div class="col-span-9">

<form id="reviewForm"
      method="POST"
      action="{{ route('reviewers.save',$assessment) }}">

    @csrf

    @foreach($domains as $domainName => $domainQuestions)

        <div id="domain{{ $loop->index }}"
             class="{{ $loop->first ? '' : 'hidden' }}">

            @include('reviewers.partials.question-panel',[
                'domainQuestions'=>$domainQuestions,
                'domainName'=>$domainName
            ])

        </div>

    @endforeach

</form>

</div>
    </div>

</div>
<script>

let openedQuestion = null;

/* ===========================================
   Question Accordion
=========================================== */

function toggleQuestion(id)
{
    let body = document.getElementById("body"+id);
    let icon = document.getElementById("icon"+id);

    if(body.classList.contains("hidden"))
    {
        document.querySelectorAll("[id^='body']").forEach(function(el){

            el.classList.add("hidden");

        });

        document.querySelectorAll("[id^='icon']").forEach(function(el){

            el.innerHTML = "+";

        });

        body.classList.remove("hidden");
        icon.innerHTML = "−";

        openedQuestion = id;
    }
    else
    {
        body.classList.add("hidden");
        icon.innerHTML = "+";
    }
}


/* ===========================================
   Intelligence Box
=========================================== */

function toggleIntelligence(id)
{
    let body = document.getElementById("intelBody"+id);
    let icon = document.getElementById("intelIcon"+id);

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


/* ===========================================
   Open Question
=========================================== */

function openQuestion(id)
{
    document.querySelectorAll("[id^='body']").forEach(function(el){

        el.classList.add("hidden");

    });

    document.querySelectorAll("[id^='icon']").forEach(function(el){

        el.innerHTML="+";

    });

    let body = document.getElementById("body"+id);

    if(body)
    {
        body.classList.remove("hidden");

        document.getElementById("icon"+id).innerHTML="−";

        body.scrollIntoView({
            behavior:"smooth",
            block:"start"
        });
    }
}


/* ===========================================
   Save Review & Next
=========================================== */

function saveReviewAndNext(currentQuestion,nextQuestion)
{
    let form = document.querySelector("form");

    let formData = new FormData(form);

    fetch(form.action,{
        method:"POST",
        body:formData,
        headers:{
            "X-CSRF-TOKEN":
            document.querySelector('input[name="_token"]').value
        }
    })
    .then(function(response){

        if(response.ok)
        {
            openQuestion(nextQuestion);
        }
    })
    .catch(function(error){

        console.log(error);

    });
}
function showDomain(index)
{
    document.querySelectorAll("[id^='domain']").forEach(function(el){

        if(el.id.startsWith("domainBtn"))
            return;

        el.classList.add("hidden");

    });

    let current=document.getElementById("domain"+index);

    if(current)
        current.classList.remove("hidden");


    document.querySelectorAll(".domain-btn").forEach(function(btn){

        btn.classList.remove("bg-blue-600","text-white");

    });

    document
        .getElementById("domainBtn"+index)
        .classList.add("bg-blue-600","text-white");
}
</script>
@endsection