@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-slate-100">

    <div class="max-w-7xl mx-auto px-8 py-8">

        {{-- ===========================
            HERO HEADER
        ============================ --}}

        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-blue-900 to-indigo-900 p-10 shadow-xl">

            <div class="absolute top-0 right-0 w-96 h-96 rounded-full bg-blue-500/10 blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-72 h-72 rounded-full bg-indigo-500/10 blur-3xl"></div>

            <div class="relative flex items-center justify-between">

                <div>

                    <span class="inline-flex items-center rounded-full bg-blue-500/20 px-4 py-1 text-sm font-semibold text-blue-100">
                        Reviewer Workspace
                    </span>

                    <h1 class="mt-5 text-5xl font-bold text-white">

                        Welcome back,
                        {{ auth()->user()->name }}

                    </h1>

                    <p class="mt-4 max-w-2xl text-lg leading-8 text-blue-100">

                        Review vendor assessments, validate submitted evidence,
                        approve security controls and monitor overall compliance.

                    </p>

                </div>

                <div class="hidden lg:block">

                    <div class="rounded-3xl bg-white/10 backdrop-blur-xl px-10 py-8 text-center">

                        <div class="text-xs uppercase tracking-[5px] text-blue-200">

                            Today

                        </div>

                        <div class="mt-3 text-5xl font-bold text-white">

                            {{ now()->format('d') }}

                        </div>

                        <div class="mt-2 text-blue-100">

                            {{ now()->format('F Y') }}

                        </div>

                    </div>

                </div>

            </div>

        </div>

        @php

            $assigned = $assessments->count();

            $responses = \App\Models\AssessmentResponse::whereHas('assessment',function($q){

                $q->where('reviewer',auth()->user()->name);

            })->get();

            $reviewed = $responses->whereNotNull('review_status')->count();

            $pending = $responses->count() - $reviewed;

            $overallProgress = $responses->count()
                ? round(($reviewed/$responses->count())*100)
                : 0;

        @endphp

        {{-- ===========================
            STATS
        ============================ --}}

       
{{-- =========================================================
    Recent Activity
========================================================= --}}

<div class="mt-8">

    <div class="flex items-center justify-between mb-5">

        <div>

            <h2 class="text-2xl font-bold text-slate-800">
                Recent Activity
            </h2>

            <p class="text-slate-500 text-sm mt-1">
                Latest review updates across your assessments
            </p>

        </div>

    </div>

    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">

        @forelse($assessments->sortByDesc('updated_at')->take(6) as $assessment)

            @php
                $totalQuestions = $assessment->responses->count();

                $reviewedQuestions = $assessment->responses
                    ->whereNotNull('review_decision')
                    ->count();

                $activityProgress = $totalQuestions
                    ? round(($reviewedQuestions / $totalQuestions) * 100)
                    : 0;
            @endphp

            <div class="flex items-start gap-5 p-6 border-b border-slate-100 last:border-0 hover:bg-slate-50 transition">

                {{-- Icon --}}
                <div class="w-12 h-12 rounded-2xl bg-blue-100 flex items-center justify-center">

                    <svg class="w-6 h-6 text-blue-600"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M9 12h6m-6 4h6M8 4h8a2 2 0 012 2v12a2 2 0 01-2 2H8a2 2 0 01-2-2V6a2 2 0 012-2z"/>

                    </svg>

                </div>

                {{-- Info --}}
                <div class="flex-1">

                    <h3 class="font-semibold text-slate-800">

                        {{ $assessment->assessment_name }}

                    </h3>

                    <div class="text-sm text-slate-500 mt-1">

                        {{ optional($assessment->vendor)->company_name }}

                    </div>

                    <div class="mt-3 w-full bg-slate-200 rounded-full h-2">

                        <div
                            class="bg-blue-600 h-2 rounded-full"
                            style="width: {{ $activityProgress }}%">
                        </div>

                    </div>

                    <div class="text-xs text-slate-500 mt-2">

                        {{ $reviewedQuestions }} / {{ $totalQuestions }}
                        Questions Reviewed

                    </div>

                </div>

                {{-- Right Side --}}
                <div class="text-right">

                    <div class="text-xs text-slate-400">

                        {{ optional($assessment->updated_at)->diffForHumans() }}

                    </div>

                    @if($activityProgress==100)

                        <span class="inline-flex mt-2 px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">

                            Completed

                        </span>

                    @elseif($activityProgress>0)

                        <span class="inline-flex mt-2 px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-semibold">

                            In Review

                        </span>

                    @else

                        <span class="inline-flex mt-2 px-3 py-1 rounded-full bg-slate-100 text-slate-700 text-xs font-semibold">

                            Pending

                        </span>

                    @endif

                </div>

            </div>

        @empty

            <div class="p-12 text-center">

                <div class="text-5xl mb-3">📄</div>

                <h3 class="font-semibold text-lg text-slate-800">

                    No Activity Yet

                </h3>

                <p class="text-slate-500 mt-2">

                    Activity will appear here after you start reviewing assessments.

                </p>

            </div>

        @endforelse

    </div>

</div>
{{-- ==========================
    MY REVIEWS
========================== --}}

<div class="mt-10">

    <div class="flex items-center justify-between mb-6">

        <div>

            <h2 class="text-2xl font-bold text-slate-900">
                My Reviews
            </h2>

            <p class="text-slate-500 mt-1">
                Assessments assigned to you
            </p>

        </div>

        <div class="flex items-center gap-3">

            <button
                class="px-4 py-2 rounded-xl border border-slate-300 bg-white hover:bg-slate-50 text-sm">

                Filter

            </button>

            <button
                class="px-4 py-2 rounded-xl border border-slate-300 bg-white hover:bg-slate-50 text-sm">

                Sort

            </button>

        </div>

    </div>

    <div class="bg-white rounded-3xl border border-slate-200 overflow-hidden shadow-sm">

        <table class="w-full">

            <thead class="bg-slate-50">

                <tr>

                    <th class="text-left px-6 py-4 text-sm font-semibold text-slate-600">
                        Assessment
                    </th>

                    <th class="text-left px-6 py-4 text-sm font-semibold text-slate-600">
                        Vendor
                    </th>

                    <th class="text-left px-6 py-4 text-sm font-semibold text-slate-600">
                        Framework
                    </th>

                    <th class="text-left px-6 py-4 text-sm font-semibold text-slate-600">
                        Progress
                    </th>

                    <th class="text-left px-6 py-4 text-sm font-semibold text-slate-600">
                        Status
                    </th>

                    <th class="text-right px-6 py-4 text-sm font-semibold text-slate-600">
                        Action
                    </th>

                </tr>

            </thead>

            <tbody class="divide-y divide-slate-100">

                @forelse($assessments as $assessment)

                    @php

                        $total = $assessment->responses->count();

                        $reviewed = $assessment->responses
                            ->whereNotNull('review_decision')
                            ->count();

                        $progress = $total
                            ? round(($reviewed/$total)*100)
                            : 0;

                    @endphp

                    <tr class="hover:bg-slate-50 transition">

                        <td class="px-6 py-5">

                            <div class="font-semibold text-slate-900">

                                {{ $assessment->assessment_name }}

                            </div>

                            <div class="text-xs text-slate-500 mt-1">

                                Assessment #{{ $assessment->id }}

                            </div>

                        </td>

                        <td class="px-6 py-5">

                            {{ optional($assessment->vendor)->company_name }}

                        </td>

                        <td class="px-6 py-5">

                            {{ optional($assessment->framework)->name }}

                        </td>

                        <td class="px-6 py-5">

                            <div class="w-48 bg-slate-200 rounded-full h-2 overflow-hidden">

                                <div
                                    class="bg-blue-600 h-2 rounded-full"
                                    style="width:{{ $progress }}%">

                                </div>

                            </div>

                            <div class="text-xs text-slate-500 mt-2">

                                {{ $reviewed }} / {{ $total }} Reviewed

                            </div>

                        </td>

                        <td class="px-6 py-5">

                            @if($progress==100)

                                <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">

                                    Completed

                                </span>

                            @elseif($progress>0)

                                <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-semibold">

                                    In Review

                                </span>

                            @else

                                <span class="px-3 py-1 rounded-full bg-slate-200 text-slate-700 text-xs font-semibold">

                                    Pending

                                </span>

                            @endif

                        </td>

                        <td class="px-6 py-5 text-right">

                            <a
                                href="{{ route('reviewers.assessment.overview',$assessment->id) }}"
                                class="inline-flex items-center gap-2 px-5 py-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-white transition">

                                Continue →

                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6" class="py-20 text-center">

                            <div class="text-5xl mb-4">
                                📄
                            </div>

                            <h3 class="font-bold text-xl text-slate-800">

                                No Assigned Reviews

                            </h3>

                            <p class="text-slate-500 mt-2">

                                Assigned assessments will appear here.

                            </p>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>
{{-- =========================================================
    REVIEW INSIGHTS
========================================================= --}}

<div class="grid grid-cols-12 gap-6 mt-10">

    {{-- Priority Reviews --}}
    <div class="col-span-12 lg:col-span-4">

        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">

            <div class="px-6 py-5 border-b bg-gradient-to-r from-red-50 to-orange-50">

                <h3 class="text-xl font-bold text-slate-800">
                    Priority Reviews
                </h3>

                <p class="text-sm text-slate-500 mt-1">
                    Assessments needing your attention
                </p>

            </div>

            <div class="divide-y divide-slate-100">

                @forelse($assessments->take(5) as $assessment)

                    @php
                        $total = $assessment->responses->count();
                        $reviewed = $assessment->responses->whereNotNull('review_decision')->count();
                        $progress = $total ? round(($reviewed/$total)*100) : 0;
                    @endphp

                    <div class="p-5 hover:bg-slate-50 transition">

                        <div class="flex justify-between">

                            <div>

                                <h4 class="font-semibold text-slate-800">
                                    {{ $assessment->assessment_name }}
                                </h4>

                                <p class="text-sm text-slate-500 mt-1">
                                    {{ optional($assessment->vendor)->company_name }}
                                </p>

                            </div>

                            @if($progress < 30)

                                <span class="px-3 py-1 rounded-full bg-red-100 text-red-600 text-xs font-bold">
                                    HIGH
                                </span>

                            @elseif($progress < 80)

                                <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-bold">
                                    MEDIUM
                                </span>

                            @else

                                <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-bold">
                                    LOW
                                </span>

                            @endif

                        </div>

                        <div class="mt-4 w-full bg-slate-200 rounded-full h-2">

                            <div
                                class="bg-blue-600 h-2 rounded-full"
                                style="width:{{ $progress }}%">
                            </div>

                        </div>

                        <div class="text-xs text-slate-500 mt-2">

                            {{ $progress }}% Reviewed

                        </div>

                    </div>

                @empty

                    <div class="p-8 text-center text-slate-500">

                        No assessments assigned.

                    </div>

                @endforelse

            </div>

        </div>

    </div>

    {{-- Recent Activity --}}
    <div class="col-span-12 lg:col-span-4">

        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">

            <div class="px-6 py-5 border-b">

                <h3 class="text-xl font-bold text-slate-800">

                    Recent Activity

                </h3>

            </div>

            <div class="divide-y divide-slate-100">

                @forelse($assessments->sortByDesc('updated_at')->take(5) as $assessment)

                    <div class="p-5 flex gap-4 items-start">

                        <div
                            class="w-11 h-11 rounded-2xl bg-blue-100 flex items-center justify-center text-blue-700 font-bold">

                            ✓

                        </div>

                        <div class="flex-1">

                            <div class="font-semibold text-slate-800">

                                {{ $assessment->assessment_name }}

                            </div>

                            <div class="text-sm text-slate-500 mt-1">

                                {{ optional($assessment->updated_at)->diffForHumans() }}

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="p-8 text-center text-slate-500">

                        No activity yet.

                    </div>

                @endforelse

            </div>

        </div>

    </div>

    {{-- Upcoming Deadlines --}}
    <div class="col-span-12 lg:col-span-4">

        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">

            <div class="px-6 py-5 border-b">

                <h3 class="text-xl font-bold text-slate-800">

                    Upcoming Deadlines

                </h3>

            </div>

            <div class="divide-y divide-slate-100">

                @forelse($assessments->take(5) as $assessment)

                    <div class="p-5">

                        <div class="font-semibold text-slate-800">

                            {{ $assessment->assessment_name }}

                        </div>

                        <div class="text-sm text-slate-500 mt-2">

                            {{ optional($assessment->vendor)->company_name }}

                        </div>

                        <div class="mt-3">

                            <span class="text-red-600 font-semibold">

                                {{ $assessment->due_date
                                    ? \Carbon\Carbon::parse($assessment->due_date)->format('d M Y')
                                    : 'No Deadline'
                                }}

                            </span>

                        </div>

                    </div>

                @empty

                    <div class="p-8 text-center text-slate-500">

                        No deadlines available.

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</div>
{{-- ==========================
    Review Analytics
========================== --}}

@php

$totalQuestions = 0;
$totalReviewed = 0;

foreach($assessments as $assessment){

    $questionsCount = $assessment->questions->count();

    $reviewedCount = $assessment->responses
        ->whereNotNull('review_decision')
        ->count();

    $totalQuestions += $questionsCount;
    $totalReviewed += $reviewedCount;
}

$pendingQuestions = $totalQuestions - $totalReviewed;

$completionPercentage = $totalQuestions > 0
    ? round(($totalReviewed / $totalQuestions) * 100)
    : 0;

@endphp

<div class="grid grid-cols-12 gap-6 mt-8">

    <div class="col-span-12 lg:col-span-8">

        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-8">

            <div class="flex items-center justify-between">

                <div>

                    <h2 class="text-2xl font-bold text-slate-800">
                        Review Analytics
                    </h2>

                    <p class="text-slate-500 mt-1">
                        Live reviewer performance
                    </p>

                </div>

                <div class="px-5 py-2 rounded-full bg-blue-100 text-blue-700 font-bold">

                    {{ $completionPercentage }}%

                </div>

            </div>

            <div class="mt-8">

                <div class="w-full bg-slate-200 rounded-full h-4 overflow-hidden">

                    <div
                        class="h-4 rounded-full bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 transition-all duration-700"
                        style="width: {{ $completionPercentage }}%">
                    </div>

                </div>

            </div>

            <div class="grid grid-cols-4 gap-6 mt-8">

                <div>

                    <p class="text-sm text-slate-500">
                        Assigned Reviews
                    </p>

                    <h3 class="text-3xl font-bold text-slate-800 mt-2">
                        {{ $assignedAssessments }}
                    </h3>

                </div>

                <div>

                    <p class="text-sm text-slate-500">
                        Total Questions
                    </p>

                    <h3 class="text-3xl font-bold text-blue-600 mt-2">
                        {{ $totalQuestions }}
                    </h3>

                </div>

                <div>

                    <p class="text-sm text-slate-500">
                        Reviewed
                    </p>

                    <h3 class="text-3xl font-bold text-green-600 mt-2">
                        {{ $totalReviewed }}
                    </h3>

                </div>

                <div>

                    <p class="text-sm text-slate-500">
                        Pending
                    </p>

                    <h3 class="text-3xl font-bold text-red-500 mt-2">
                        {{ $pendingQuestions }}
                    </h3>

                </div>

            </div>

        </div>

    </div>

    <div class="col-span-12 lg:col-span-4">

        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-8 h-full">

            <h2 class="text-2xl font-bold text-slate-800">
                Performance Summary
            </h2>

            <div class="flex justify-center mt-8">

                <div class="relative w-44 h-44">

                    <svg class="w-44 h-44 -rotate-90">

                        <circle
                            cx="88"
                            cy="88"
                            r="72"
                            stroke="#e5e7eb"
                            stroke-width="12"
                            fill="none"
                        />

                        <circle
                            cx="88"
                            cy="88"
                            r="72"
                            stroke="#2563eb"
                            stroke-width="12"
                            fill="none"
                            stroke-linecap="round"
                            stroke-dasharray="{{ 2 * pi() * 72 }}"
                            stroke-dashoffset="{{ (2 * pi() * 72) - ((2 * pi() * 72) * $completionPercentage / 100) }}"
                        />

                    </svg>

                    <div class="absolute inset-0 flex flex-col items-center justify-center">

                        <div class="text-5xl font-bold text-blue-700">

                            {{ $completionPercentage }}

                        </div>

                        <div class="text-slate-500">

                            %

                        </div>

                    </div>

                </div>

            </div>

            <div class="space-y-4 mt-8">

                <div class="flex justify-between">

                    <span class="text-slate-500">
                        Completed
                    </span>

                    <span class="font-bold text-green-600">

                        {{ $totalReviewed }}

                    </span>

                </div>

                <div class="flex justify-between">

                    <span class="text-slate-500">
                        Pending
                    </span>

                    <span class="font-bold text-red-500">

                        {{ $pendingQuestions }}

                    </span>

                </div>

                <div class="flex justify-between">

                    <span class="text-slate-500">
                        Total Questions
                    </span>

                    <span class="font-bold">

                        {{ $totalQuestions }}

                    </span>

                </div>

            </div>

        </div>

    </div>

</div>
{{-- ==========================================
    Bottom Section
========================================== --}}

<div class="grid grid-cols-12 gap-6 mt-8">

    {{-- ==========================
        Recent Activity
    ========================== --}}

    <div class="col-span-12 lg:col-span-6">

        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm">

            <div class="px-6 py-5 border-b border-slate-100">

                <h2 class="text-xl font-bold text-slate-800">
                    Recent Activity
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    Latest review actions
                </p>

            </div>

            <div class="divide-y divide-slate-100">

                @forelse($assessments->sortByDesc('updated_at')->take(6) as $assessment)

                    @php
                        $reviewed = $assessment->responses
                            ->whereNotNull('review_decision')
                            ->count();
                    @endphp

                    <div class="flex items-center justify-between px-6 py-5 hover:bg-slate-50 transition">

                        <div class="flex items-center gap-4">

                            <div class="w-11 h-11 rounded-2xl bg-blue-100 flex items-center justify-center text-blue-700 font-bold">

                                ✓

                            </div>

                            <div>

                                <div class="font-semibold text-slate-800">

                                    {{ $assessment->assessment_name }}

                                </div>

                                <div class="text-sm text-slate-500">

                                    {{ optional($assessment->vendor)->company_name }}

                                </div>

                            </div>

                        </div>

                        <div class="text-right">

                            <div class="font-semibold text-blue-600">

                                {{ $reviewed }} Reviewed

                            </div>

                            <div class="text-xs text-slate-500 mt-1">

                                {{ $assessment->updated_at->diffForHumans() }}

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="p-8 text-center text-slate-500">

                        No activity available.

                    </div>

                @endforelse

            </div>

        </div>

    </div>

    {{-- ==========================
        Upcoming Deadlines
    ========================== --}}

    <div class="col-span-12 lg:col-span-6">

        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm">

            <div class="px-6 py-5 border-b border-slate-100">

                <h2 class="text-xl font-bold text-slate-800">
                    Upcoming Deadlines
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    Assessments due soon
                </p>

            </div>

            <div class="divide-y divide-slate-100">

                @forelse($assessments->sortBy('due_date')->take(6) as $assessment)

                    <div class="flex items-center justify-between px-6 py-5 hover:bg-slate-50 transition">

                        <div>

                            <div class="font-semibold text-slate-800">

                                {{ $assessment->assessment_name }}

                            </div>

                            <div class="text-sm text-slate-500 mt-1">

                                {{ optional($assessment->vendor)->company_name }}

                            </div>

                        </div>

                        <div class="text-right">

                            <div class="font-semibold text-red-600">

                                {{ $assessment->due_date ? \Carbon\Carbon::parse($assessment->due_date)->format('d M Y') : 'Not Set' }}

                            </div>

                            <div class="text-xs text-slate-500 mt-1">

                                Due Date

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="p-8 text-center text-slate-500">

                        No deadlines available.

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</div>

@endsection
