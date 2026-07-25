@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-6">

    <!-- Header -->
    <div class="bg-white shadow rounded-xl p-6 mb-6">

        <h1 class="text-3xl font-bold text-gray-800">
            {{ $assessment->assessment_name }}
        </h1>

        <p class="text-gray-500 mt-2">
            Reviewer Assessment Overview
        </p>

    </div>

    <!-- Assessment Details -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">

        <div class="bg-white rounded-xl shadow p-5">
            <p class="text-gray-500 text-sm">Vendor</p>
            <h3 class="font-bold text-lg">
                {{ $assessment->vendor->vendor_name }}
            </h3>
        </div>

        <div class="bg-white rounded-xl shadow p-5">
            <p class="text-gray-500 text-sm">Framework</p>
            <h3 class="font-bold text-lg">
                {{ $assessment->framework->name ?? 'N/A' }}
            </h3>
        </div>

        <div class="bg-white rounded-xl shadow p-5">
            <p class="text-gray-500 text-sm">Priority</p>
            <h3 class="font-bold text-lg">
                {{ $assessment->priority }}
            </h3>
        </div>

        <div class="bg-white rounded-xl shadow p-5">
            <p class="text-gray-500 text-sm">Due Date</p>
            <h3 class="font-bold text-lg">
                {{ \Carbon\Carbon::parse($assessment->due_date)->format('d M Y') }}
            </h3>
        </div>

    </div>

    <!-- Progress -->
    <div class="bg-white shadow rounded-xl p-6 mb-8">

        <div class="flex justify-between mb-3">

            <span class="font-semibold">
                Assessment Progress
            </span>

            <span>
                0%
            </span>

        </div>

        <div class="w-full bg-gray-200 rounded-full h-3">

            <div class="bg-green-500 h-3 rounded-full" style="width:0%"></div>

        </div>

    </div>

    <!-- Domains -->
    <!-- Domains -->
<h2 class="text-2xl font-bold mb-5">
    Review Domains
</h2>

<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

    @foreach($domains as $domainQuestions)

        @php
            $domain = $domainQuestions->first()->question->domain;
        @endphp

        <div class="bg-white rounded-xl shadow hover:shadow-xl transition p-6">

            <h3 class="text-xl font-bold mb-2">
                {{ $domain->name }}
            </h3>

            <p class="text-gray-600 mb-4">
                Questions :
                {{ $domainQuestions->count() }}
            </p>


            <div class="mb-5">

                @php
                    $answered = $domainQuestions
                        ->whereNotNull('response.answer')
                        ->count();

                    $total = $domainQuestions->count();
                @endphp


                @if($answered == 0)

                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                        Not Started
                    </span>

                @elseif($answered < $total)

                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
                        In Progress
                    </span>

                @else

                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                        Completed
                    </span>

                @endif

            </div>


             @foreach($domains as $domainName => $domainQuestions)

        <button
            type="button"
            onclick="showDomain({{ $loop->index }})"
            id="domainBtn{{ $loop->index }}"
            class="domain-btn w-full text-left mb-3 rounded-xl border p-4 hover:bg-blue-50">

            <div class="flex justify-between">

                <span class="font-semibold">
                    {{ $domainName }}
                </span>

                <span class="text-sm text-slate-500">
                    {{ $domainQuestions->count() }}
                </span>

            </div>

        </button>

    @endforeach


        </div>

    @endforeach

</div>

</div>

@endsection