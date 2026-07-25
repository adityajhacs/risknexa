
        
                {{-- ==========================
            DOMAIN HEADER
        =========================== --}}

                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mb-6">

                    <div class="flex justify-between items-center">

                        <div>

                            <h2 class="text-2xl font-bold text-slate-800">
                                {{ $domainName }}
                            </h2>

                            <p class="text-slate-500 mt-1">
                                {{ $domainQuestions->count() }} Questions
                            </p>

                        </div>

                        <span class="px-4 py-2 rounded-full bg-blue-100 text-blue-700 font-semibold">

                            Review Workspace

                        </span>

                    </div>

                </div>

                {{-- ==========================
            QUESTIONS
        =========================== --}}

                @foreach ($domainQuestions as $question)
                    @php

                        $response = $responses[$question->id] ?? null;

                        $currentIndex = $domainQuestions->search(function ($q) use ($question) {
                            return $q->id == $question->id;
                        });

                        $previousQuestion = $currentIndex > 0 ? $domainQuestions[$currentIndex - 1] : null;

                        $nextQuestion =
                            $currentIndex < $domainQuestions->count() - 1 ? $domainQuestions[$currentIndex + 1] : null;

                        $isReviewed = !empty($response?->review_decision);

                    @endphp

                    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 mb-6 overflow-hidden">

                        {{-- ==========================
                QUESTION HEADER
            =========================== --}}

                        <button type="button" onclick="toggleQuestion({{ $question->id }})"
                            class="w-full flex justify-between items-start p-6 bg-gradient-to-r from-slate-50 to-slate-100 hover:from-blue-50 hover:to-indigo-50 transition">

                            <div class="flex-1 text-left">

                                <div class="flex items-center gap-3 flex-wrap">

                                    <h2 class="text-xl font-bold text-slate-800">

                                        Question {{ $currentIndex + 1 }}

                                    </h2>

                                    @if ($isReviewed)
                                        <span
                                            class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">

                                            Reviewed

                                        </span>
                                    @else
                                        <span
                                            class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-semibold">

                                            Pending Review

                                        </span>
                                    @endif

                                    @if ($question->risk_level)
                                        <span
                                            class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-semibold">

                                            {{ $question->risk_level }}

                                        </span>
                                    @endif

                                </div>

                                <p class="mt-5 text-lg text-slate-800 leading-7">

                                    {{ $question->question }}

                                </p>

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

                                <span id="icon{{ $question->id }}" class="text-3xl font-bold">

                                    +

                                </span>

                            </div>

                        </button>

                        {{-- BODY START --}}

                        <div id="body{{ $question->id }}"
                            class="{{ $currentQuestion == $question->id ? '' : 'hidden' }} p-6">
                            {{-- =====================================================
    Assessment Intelligence
===================================================== --}}

                            <div
                                class="rounded-2xl border border-blue-200 bg-gradient-to-r from-blue-50 to-indigo-50 p-6 mb-8">

                                <div class="flex justify-between items-center mb-6">

                                    <h2 class="text-xl font-bold text-slate-800">

                                        Assessment Intelligence

                                    </h2>

                                    <button type="button" onclick="toggleIntelligence({{ $question->id }})"
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

                                                @if ($question->expected_evidence)
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

                                                @if (!empty($response?->review_status))
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

                                                {{ $response->review_comment ?? 'No comments yet.' }}

                                            </p>

                                        </div>

                                    </div>

                                </div>

                            </div>
                            {{-- =====================================================
    Vendor Submission
===================================================== --}}

                            <div class="bg-white rounded-2xl border border-slate-200 p-6 mb-8">

                                <h2 class="text-xl font-bold text-slate-800 mb-6">

                                    Vendor Submission

                                </h2>

                                {{-- ==========================================
        Implementation Status
    ========================================== --}}

                                <div class="mb-6">

                                    <label class="block text-sm font-semibold text-slate-700 mb-2">

                                        Implementation Status

                                    </label>

                                    <div class="rounded-xl border bg-slate-50 p-4 text-slate-800 font-medium">

                                        {{ $response->implementation_status ?? 'Not Provided' }}

                                    </div>

                                </div>

                                {{-- ==========================================
        Implementation Narrative
    ========================================== --}}

                                <div class="mb-8">

                                    <label class="block text-sm font-semibold text-slate-700 mb-2">

                                        Implementation Narrative

                                    </label>

                                    <div
                                        class="rounded-2xl border bg-slate-50 p-5 min-h-[180px] whitespace-pre-line text-slate-700">

                                        {{ $response->answer ?? 'Vendor has not submitted any implementation narrative.' }}

                                    </div>

                                </div>

                                {{-- ==========================================
        Submitted Evidence
    ========================================== --}}

                                <div class="mb-8">

                                    <label class="block text-sm font-semibold text-slate-700 mb-3">

                                        Submitted Evidence

                                    </label>

                                    @if (!empty($response?->evidence_file))
                                        <div class="flex flex-wrap gap-3">

                                            <span
                                                class="px-4 py-2 rounded-full bg-green-100 text-green-700 text-sm font-semibold">

                                                ✅ Evidence Uploaded

                                            </span>

                                            <a href="{{ asset('storage/' . $response->evidence_file) }}" target="_blank"
                                                class="px-5 py-2 rounded-xl bg-blue-600 text-white hover:bg-blue-700">

                                                View Evidence

                                            </a>

                                            <a href="{{ asset('storage/' . $response->evidence_file) }}" download
                                                class="px-5 py-2 rounded-xl border hover:bg-slate-100">

                                                Download Evidence

                                            </a>

                                        </div>
                                    @else
                                        <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-red-600">

                                            Vendor has not uploaded any evidence.

                                        </div>
                                    @endif

                                </div>

                            </div>
                            {{-- =====================================================
    Reviewer Decision
===================================================== --}}

                            <div class="bg-white rounded-2xl border border-slate-200 p-6 mb-8">

                                <h2 class="text-xl font-bold text-slate-800 mb-6">

                                    Reviewer Decision

                                </h2>

                                {{-- =========================
        Decision
    ========================== --}}

                                <div class="mb-8">

                                    <label class="block text-sm font-semibold text-slate-700 mb-4">

                                        Review Decision

                                    </label>

                                    <div class="grid md:grid-cols-3 gap-4">

                                        {{-- Accept --}}

                                        <label class="cursor-pointer">

                                            <input type="radio" name="decision[{{ $question->id }}]" value="Accepted"
                                                class="hidden peer"
                                                {{ ($response->review_decision ?? '') == 'Accepted' ? 'checked' : '' }}>

                                            <div
                                                class="rounded-xl border-2 border-green-300 p-5 text-center
                    peer-checked:bg-green-600
                    peer-checked:text-white
                    peer-checked:border-green-600
                    transition">

                                                ✅

                                                <div class="mt-2 font-semibold">

                                                    Accept

                                                </div>

                                            </div>

                                        </label>

                                        {{-- Reject --}}

                                        <label class="cursor-pointer">

                                            <input type="radio" name="decision[{{ $question->id }}]" value="Rejected"
                                                class="hidden peer"
                                                {{ ($response->review_decision ?? '') == 'Rejected' ? 'checked' : '' }}>

                                            <div
                                                class="rounded-xl border-2 border-red-300 p-5 text-center
                    peer-checked:bg-red-600
                    peer-checked:text-white
                    peer-checked:border-red-600
                    transition">

                                                ❌

                                                <div class="mt-2 font-semibold">

                                                    Reject

                                                </div>

                                            </div>

                                        </label>

                                        {{-- Clarification --}}

                                        <label class="cursor-pointer">

                                            <input type="radio" name="decision[{{ $question->id }}]"
                                                value="Clarification Required" class="hidden peer"
                                                {{ ($response->review_decision ?? '') == 'Clarification Required' ? 'checked' : '' }}>

                                            <div
                                                class="rounded-xl border-2 border-yellow-300 p-5 text-center
                    peer-checked:bg-yellow-500
                    peer-checked:text-white
                    peer-checked:border-yellow-500
                    transition">

                                                💬

                                                <div class="mt-2 font-semibold">

                                                    Clarification Required

                                                </div>

                                            </div>

                                        </label>

                                    </div>

                                </div>

                                {{-- =========================
        Review Score
    ========================== --}}

                                <div class="mb-8">

                                    <label class="block text-sm font-semibold text-slate-700 mb-2">

                                        Review Score

                                    </label>

                                    <input type="number" name="score[{{ $question->id }}]" min="0"
                                        max="100" value="{{ $response->review_score ?? '' }}"
                                        class="w-40 rounded-xl border border-slate-300 p-3">

                                </div>

                                {{-- =========================
        Reviewer Comment
    ========================== --}}

                                <div>

                                    <label class="block text-sm font-semibold text-slate-700 mb-2">

                                        Reviewer Comment

                                    </label>

                                    <textarea name="comments[{{ $question->id }}]" rows="6" class="w-full rounded-2xl border border-slate-300 p-4"
                                        placeholder="Write review comments...">{{ old('comments.' . $question->id, $response->review_comment ?? '') }}</textarea>

                                </div>

                            </div>
                            {{-- =====================================================
    Navigation
===================================================== --}}

                            <div class="flex justify-between items-center border-t pt-6">

                                {{-- Previous --}}

                                <div>

                                    @if ($previousQuestion)
                                        <button type="button" onclick="openQuestion({{ $previousQuestion->id }})"
                                            class="px-5 py-2 rounded-xl border hover:bg-slate-100">

                                            ← Previous

                                        </button>
                                    @endif

                                </div>

                                {{-- Right Buttons --}}

                                <div class="flex gap-3">

                                    {{-- Save Review --}}

                                    <button type="submit"
                                        class="px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold">

                                        Save Review

                                    </button>

                                    {{-- Save Review & Next --}}

                                    @if ($nextQuestion)
                                        <button type="button"
                                            onclick="saveReviewAndNext({{ $question->id }}, {{ $nextQuestion->id }})"
                                            class="px-6 py-3 rounded-xl bg-green-600 hover:bg-green-700 text-white font-semibold">

                                            Save Review & Next →

                                        </button>
                                    @endif

                                </div>

                            </div>


                            {{-- =====================================================
    Footer
===================================================== --}}

                            <div class="mt-8 flex justify-between items-center border-t pt-6">

                                <div>

                                    @if ($response)
                                        <span class="text-slate-500">

                                            Last Updated :

                                            {{ optional($response->updated_at)->format('d M Y h:i A') }}

                                        </span>
                                    @endif

                                </div>

                                <div>

                                    @if ($response)
                                        <span class="px-4 py-2 rounded-full bg-slate-100 text-slate-700">

                                            {{ $response->review_status ?? 'Pending Review' }}

                                        </span>
                                    @endif

                                </div>

                            </div>

                        </div> {{-- BODY END --}}

                    </div> {{-- QUESTION CARD END --}}
                @endforeach

   