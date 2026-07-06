@php
$totalQuestions = $questions->count();

$answered = $responses->filter(function ($response) {
    return trim($response->answer ?? '') !== '';
})->count();

$progress = $totalQuestions
    ? round(($answered / $totalQuestions) * 100)
    : 0;

$isSubmitted = $assessment->status === 'Submitted';
@endphp

<x-app-layout>

<div class="max-w-7xl mx-auto p-6">

    {{-- Success Message --}}
    @if(session('success'))
        <div class="mb-6 rounded-xl bg-green-100 border border-green-300 text-green-700 px-5 py-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Error Message --}}
    @if(session('error'))
        <div class="mb-6 rounded-xl bg-red-100 border border-red-300 text-red-700 px-5 py-4">
            {{ session('error') }}
        </div>
    @endif

    {{-- Hero --}}
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

    {{-- Progress --}}
    <div class="bg-white rounded-2xl shadow-sm p-6 mb-8">

        <div class="flex justify-between mb-3">

            <span class="font-semibold">
                Assessment Progress
            </span>

            <span class="font-bold text-blue-600">

                {{ $progress }}%

            </span>

        </div>

        <div class="w-full bg-slate-200 rounded-full h-4">

            <div
                class="bg-gradient-to-r from-blue-500 to-indigo-600 h-4 rounded-full"
                style="width: {{ $progress }}%">
            </div>

        </div>

    </div>

    {{-- Assessment Info --}}
    <div class="grid md:grid-cols-4 gap-6 mb-8">

        <div class="bg-white rounded-2xl p-6 shadow">
            <p>Status</p>
            <h2 class="text-xl font-bold text-green-600">
                {{ $assessment->status }}
            </h2>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow">
            <p>Questions</p>
            <h2 class="text-xl font-bold text-blue-600">
                {{ $questions->count() }}
            </h2>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow">
            <p>Risk</p>
            <h2 class="text-xl font-bold text-red-600">
                {{ $assessment->risk_level ?? 'Pending' }}
            </h2>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow">
            <p>Due Date</p>
            <h2 class="text-xl font-bold">
                {{ \Carbon\Carbon::parse($assessment->due_date)->format('d M Y') }}
            </h2>
        </div>

    </div>

    {{-- Submitted Banner --}}
    @if($isSubmitted)

    <div class="mb-8 rounded-2xl bg-green-100 border border-green-300 p-5">

        <h2 class="font-bold text-green-700 text-lg">

            Assessment Submitted

        </h2>

        <p class="text-green-600 mt-2">

            This assessment is locked. You can only view your answers.

        </p>

    </div>

    @endif

    {{-- Questions --}}
    @foreach($questions as $index => $question)

        @include('vendor.partials.question-card')

    @endforeach

    {{-- Submit Button --}}
    @unless($isSubmitted)

    <form
        method="POST"
        action="{{ route('vendor.assessments.submit',$assessment->id) }}"
    >

        @csrf

        <div class="flex justify-end mt-8">

            <button
                class="px-8 py-3 rounded-xl bg-green-600 text-white hover:bg-green-700">

                Submit Assessment

            </button>

        </div>

    </form>

    @endunless

</div>

</x-app-layout>