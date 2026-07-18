@php

$isSubmitted = $assessment->status == 'Submitted';

$response = $responses[$question->id] ?? null;

$isAnswered = !empty($response?->answer);

@endphp


<div class="bg-white rounded-2xl shadow-sm border border-slate-200 mb-6 overflow-hidden">

    {{-- =========================
        Question Header
    ========================== --}}

    <button
        type="button"
        onclick="toggleQuestion({{ $question->id }})"
        class="w-full flex justify-between items-start p-6 bg-gradient-to-r from-slate-50 to-slate-100 hover:from-blue-50 hover:to-indigo-50 transition">

        <div class="flex-1 text-left">

            <div class="flex items-center gap-3 flex-wrap">

                <h2 class="text-xl font-bold text-slate-800">

                    Question {{ $currentIndex + 1 }}

                </h2>

                @if($isAnswered)

                    <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">

                        Answered

                    </span>

                @else

                    <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-semibold">

                        Pending

                    </span>

                @endif

                @if($question->risk_level)

                    <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-semibold">

                        {{ $question->risk_level }}

                    </span>

                @endif

            </div>


            <p class="mt-5 text-slate-800 text-lg leading-7">

                {{ $question->question }}

            </p>


            {{-- Control Information --}}

            <div class="grid md:grid-cols-4 gap-5 mt-6">

                <div>

                    <p class="text-xs uppercase text-slate-400">

                        Control Code

                    </p>

                    <p class="font-semibold mt-1">

                        {{ $question->control_code ?? '-' }}

                    </p>

                </div>

                <div>

                    <p class="text-xs uppercase text-slate-400">

                        Category

                    </p>

                    <p class="font-semibold mt-1">

                        {{ optional($question->category)->name ?? '-' }}

                    </p>

                </div>

                <div>

                    <p class="text-xs uppercase text-slate-400">

                        Domain

                    </p>

                    <p class="font-semibold mt-1">

                        {{ optional($question->domain)->name ?? '-' }}

                    </p>

                </div>

                <div>

                    <p class="text-xs uppercase text-slate-400">

                        Weight

                    </p>

                    <p class="font-semibold mt-1">

                        {{ $question->risk_weight ?? '-' }}

                    </p>

                </div>

            </div>

        </div>

        <div class="ml-6">

            <span
                id="icon{{ $question->id }}"
                class="text-3xl font-bold">

                +

            </span>

        </div>

    </button>



    {{-- =========================
        BODY
    ========================== --}}

   <div
    id="body{{ $question->id }}"
    data-question="{{ $question->id }}"
    class="{{ $currentQuestion == $question->id ? '' : 'hidden' }}"
>
        {{-- =====================================================
    Assessment Intelligence
===================================================== --}}

<div class="rounded-2xl border border-blue-200 bg-gradient-to-r from-blue-50 to-indigo-50 p-6 mb-8">

    <div class="flex justify-between items-center mb-6">

        <h2 class="text-xl font-bold text-slate-800">

            Assessment Intelligence

        </h2>

        <button
            type="button"
            onclick="toggleIntelligence({{ $question->id }})"
            class="text-blue-600 font-semibold">

            <span id="intelIcon{{ $question->id }}">−</span>

        </button>

    </div>

    <div id="intelBody{{ $question->id }}">

        <div class="grid md:grid-cols-2 gap-6">

            {{-- Description --}}

            <div class="bg-white rounded-xl border p-5">

                <p class="text-xs uppercase tracking-wide text-slate-500">

                    Description

                </p>

                <p class="mt-3 text-slate-700 leading-7">

                    {{ $question->description ?: 'No description available.' }}

                </p>

            </div>

            {{-- Control Guidance --}}

            <div class="bg-white rounded-xl border p-5">

                <p class="text-xs uppercase tracking-wide text-slate-500">

                    Control Guidance

                </p>

                <p class="mt-3 text-slate-700 leading-7">

                    {{ $question->control_guidance ?: 'No guidance available.' }}

                </p>

            </div>

        </div>



        <div class="grid md:grid-cols-3 gap-6 mt-6">

            {{-- Expected Evidence --}}

            <div class="bg-white rounded-xl border p-5">

                <p class="text-xs uppercase text-slate-500">

                    Expected Evidence

                </p>

                <div class="mt-3 text-slate-700 leading-7">

                    @if($question->expected_evidence)

                        {!! nl2br(e($question->expected_evidence)) !!}

                    @else

                        Policy Document<br>
                        Screenshot<br>
                        Configuration Export

                    @endif

                </div>

            </div>

            {{-- Review Status --}}

            <div class="bg-white rounded-xl border p-5">

                <p class="text-xs uppercase text-slate-500">

                    Review Status

                </p>

                <div class="mt-3">

                    @if(!empty($response->review_status))

                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-700">

                            {{ $response->review_status }}

                        </span>

                    @else

                        <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700">

                            Pending Review

                        </span>

                    @endif

                </div>

            </div>

            {{-- Reviewer Comment --}}

            <div class="bg-white rounded-xl border p-5">

                <p class="text-xs uppercase text-slate-500">

                    Reviewer Comment

                </p>

                <p class="mt-3 text-slate-700 leading-7">

                    {{ $response->review_comment ?? 'No comments available.' }}

                </p>

            </div>

        </div>

    </div>

</div>



{{-- =====================================================
    Implementation Details
===================================================== --}}

<div class="bg-white rounded-2xl border border-slate-200 p-6 mb-8">

    <h2 class="text-xl font-bold text-slate-800 mb-6">

        Implementation Details

    </h2>
    {{-- ==========================================
    Implementation Status
========================================== --}}

<div class="mb-6">

    <label class="block text-sm font-semibold text-slate-700 mb-2">

        Implementation Status

    </label>

    <select
        name="implementation_status"
        class="w-full rounded-xl border border-slate-300 p-3 focus:ring-2 focus:ring-blue-500"
        @if($isSubmitted) disabled @endif>

        <option value="">Select Status</option>

        <option value="Implemented"
            {{ ($response->implementation_status ?? '')=='Implemented' ? 'selected':'' }}>
            ✅ Implemented
        </option>

        <option value="Partially Implemented"
            {{ ($response->implementation_status ?? '')=='Partially Implemented' ? 'selected':'' }}>
            🟡 Partially Implemented
        </option>

        <option value="Planned"
            {{ ($response->implementation_status ?? '')=='Planned' ? 'selected':'' }}>
            🔵 Planned
        </option>

        <option value="Not Implemented"
            {{ ($response->implementation_status ?? '')=='Not Implemented' ? 'selected':'' }}>
            🔴 Not Implemented
        </option>

        <option value="Not Applicable"
            {{ ($response->implementation_status ?? '')=='Not Applicable' ? 'selected':'' }}>
            ⚪ Not Applicable
        </option>

    </select>

</div>



{{-- ==========================================
    Implementation Narrative
========================================== --}}

<div class="mb-8">

    <label class="block text-sm font-semibold text-slate-700 mb-2">

        Implementation Narrative

    </label>

    <textarea
        name="answer"
        rows="7"
        class="w-full rounded-2xl border border-slate-300 bg-slate-50 p-4 focus:ring-2 focus:ring-blue-500"
        placeholder="Describe how your organization has implemented this control..."
        @if($isSubmitted) readonly @endif>{{ old('answer',$response->answer ?? '') }}</textarea>

    <p class="text-xs text-slate-500 mt-2">

        Explain implementation process, technologies used, policies followed and operational procedures.

    </p>

</div>



{{-- ==========================================
    Upload Evidence
========================================== --}}

<div class="mb-8">

    <label class="block text-sm font-semibold text-slate-700 mb-3">

        Upload Evidence

    </label>

    @if(!$isSubmitted)

        <input
            type="file"
            name="evidence"
            @if($isSubmitted)

disabled

@endif
            class="block w-full rounded-xl border-2 border-dashed border-blue-300 bg-blue-50 p-5">

    @endif


    @if(!empty($response->evidence_file))

        <div class="mt-5 flex flex-wrap gap-3">

            <span
                class="px-4 py-2 rounded-full bg-green-100 text-green-700 text-sm font-semibold">

                ✅ Evidence Uploaded

            </span>

            <a
                href="{{ asset('storage/'.$response->evidence_file) }}"
                target="_blank"
                class="px-5 py-2 rounded-xl bg-blue-600 text-white hover:bg-blue-700">

                View Evidence

            </a>

            <a
                href="{{ asset('storage/'.$response->evidence_file) }}"
                download
                class="px-5 py-2 rounded-xl border hover:bg-slate-100">

                Download

            </a>

        </div>

    @else

        <div class="mt-4">

            <span class="text-red-500 text-sm">

                No evidence uploaded.

            </span>

        </div>

    @endif

</div>

</div>
{{-- =====================================================
    Assessment Intelligence Summary
===================================================== --}}

<div class="rounded-2xl border border-slate-200 bg-slate-50 p-6 mb-8">

    <div class="flex items-center justify-between mb-5">

        <h2 class="text-xl font-bold text-slate-800">

            Assessment Intelligence Summary

        </h2>

        @php

            $completed = 0;

            if(!empty($response?->implementation_status)) $completed++;
            if(!empty($response?->answer)) $completed++;
            if(!empty($response?->evidence_file)) $completed++;
            if(!empty($response?->explanation)) $completed++;

        @endphp

        <span class="px-4 py-2 rounded-full bg-blue-600 text-white text-sm">

            {{ $completed }}/4 Completed

        </span>

    </div>


    <div class="space-y-4">

        {{-- Implementation Status --}}

        <div class="flex justify-between items-center">

            <span>

                Implementation Status

            </span>

            @if(!empty($response?->implementation_status))

                <span class="text-green-600 font-semibold">

                    ✔ Completed

                </span>

            @else

                <span class="text-red-600 font-semibold">

                    ✖ Missing

                </span>

            @endif

        </div>


        {{-- Narrative --}}

        <div class="flex justify-between items-center">

            <span>

                Implementation Narrative

            </span>

            @if(!empty($response?->answer))

                <span class="text-green-600 font-semibold">

                    ✔ Completed

                </span>

            @else

                <span class="text-red-600 font-semibold">

                    ✖ Missing

                </span>

            @endif

        </div>


        {{-- Evidence --}}

        <div class="flex justify-between items-center">

            <span>

                Evidence Upload

            </span>

            @if(!empty($response?->evidence_file))

                <span class="text-green-600 font-semibold">

                    ✔ Completed

                </span>

            @else

                <span class="text-red-600 font-semibold">

                    ✖ Missing

                </span>

            @endif

        </div>


        {{-- Explanation --}}

        <div class="flex justify-between items-center">

            <span>

                Explanation

            </span>

            @if(!empty($response?->explanation))

                <span class="text-green-600 font-semibold">

                    ✔ Completed

                </span>

            @else

                <span class="text-red-600 font-semibold">

                    ✖ Missing

                </span>

            @endif

        </div>

    </div>

</div>



{{-- =====================================================
    Review Status
===================================================== --}}

<div class="rounded-2xl border bg-white p-6 mb-8">

    <div class="flex justify-between items-center">

        <div>

            <h3 class="font-bold text-lg">

                Review Status

            </h3>

            <p class="text-slate-500 mt-1">

                Reviewer will verify your submitted response.

            </p>

        </div>

        <span class="px-4 py-2 rounded-full bg-yellow-100 text-yellow-700 font-semibold">

            {{ $response->review_status ?? 'Pending Review' }}

        </span>

    </div>

</div>



{{-- =====================================================
    Navigation Buttons
===================================================== --}}

<div class="flex flex-wrap justify-between items-center border-t pt-6">

    {{-- Previous --}}

    <div>

        @if($previousQuestion)

            <button
                type="button"
                onclick="openQuestion({{ $previousQuestion->id }})"
                class="px-5 py-2 rounded-xl border hover:bg-slate-100">

                ← Previous

            </button>

        @endif

    </div>



    <div class="flex flex-wrap gap-3">

        {{-- Save --}}

        <button
            type="submit"
            class="px-6 py-2 rounded-xl bg-blue-600 text-white hover:bg-blue-700"
            @if($isSubmitted) disabled @endif>

            Save

        </button>



        {{-- Save & Next --}}

        @if($nextQuestion)
           
            <button
                type="button"
                onclick="saveAndNext({{ $question->id }},{{ $nextQuestion->id }})"
                class="px-6 py-2 rounded-xl bg-green-600 text-white hover:bg-green-700"
                @if($isSubmitted) disabled @endif>

                Save & Next →

            </button>

        @endif


       

    </div>

</div>
{{-- =====================================================
    Footer Actions
===================================================== --}}

<div class="mt-8 flex flex-wrap justify-between items-center border-t pt-6">

    {{-- Left Side --}}

    <div class="flex flex-wrap gap-3">

        @if($response)

            <a
                href="{{ route('vendor.assessments.history',[$assessment->id,$question->id]) }}"
                class="px-5 py-2 rounded-xl border border-slate-300 hover:bg-slate-100 transition">

                📜 View History

            </a>

        @endif

    </div>



    {{-- Right Side --}}

    <div class="text-sm text-slate-500">

        Last Updated :

        @if($response)

            {{ $response->updated_at->format('d M Y h:i A') }}

        @else

            Not Saved Yet

        @endif

    </div>

</div>



{{-- =====================================================
    Compliance Tips
===================================================== --}}

<div class="mt-8 rounded-2xl bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 p-6">

    <div class="flex items-start gap-4">

        <div class="text-3xl">

            💡

        </div>

        <div>

            <h3 class="font-bold text-green-700 text-lg">

                Compliance Tip

            </h3>

            <p class="mt-2 text-slate-700 leading-7">

                Ensure that your implementation narrative clearly explains how the
                control is implemented within your organization. Upload valid
                evidence such as policy documents, screenshots, reports or
                configuration exports to support your response.

            </p>

        </div>

    </div>

</div>



</div> {{-- Body End --}}

</div> {{-- Question Card End --}}