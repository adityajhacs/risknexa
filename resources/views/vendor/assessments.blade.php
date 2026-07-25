@extends('layouts.vendor')

@section('content')

<div class="max-w-7xl mx-auto p-6">

    <div class="mb-8">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white rounded-3xl p-8 mb-8">

            <p class="uppercase tracking-wider text-sm opacity-80">
                Vendor Portal
            </p>

            <h1 class="text-4xl font-bold mt-2">
                Welcome Back, {{ auth()->user()->name }}
            </h1>

            <p class="mt-3 text-blue-100">
                Complete assigned assessments and upload compliance evidence.
            </p>

        </div>

        <h1 class="text-4xl font-bold text-slate-900">
            My Assessments
        </h1>

        <p class="text-slate-500 mt-2">
            View assigned assessments and submit compliance responses.
        </p>

    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

        <div class="bg-white rounded-2xl shadow-sm p-6">
            <p class="text-slate-500">Total Assessments</p>
            <h2 class="text-4xl font-bold mt-2">
                {{ $assessments->count() }}
            </h2>
        </div>

        <div class="bg-white rounded-2xl shadow-sm p-6">
            <p class="text-slate-500">Submitted</p>
            <h2 class="text-4xl font-bold text-green-600 mt-2">
                {{ $assessments->where('status','Submitted')->count() }}
            </h2>
        </div>

        <div class="bg-white rounded-2xl shadow-sm p-6">
            <p class="text-slate-500">Pending</p>
            <h2 class="text-4xl font-bold text-yellow-500 mt-2">
                {{ $assessments->where('status','Pending')->count() }}
            </h2>
        </div>

        <div class="bg-white rounded-2xl shadow-sm p-6">
            <p class="text-slate-500">High Risk</p>
            <h2 class="text-4xl font-bold text-red-600 mt-2">
                {{ $assessments->where('risk_level','High')->count() }}
            </h2>
        </div>

    </div>

    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">

        <table class="w-full">

            <thead class="bg-slate-50 border-b">
                <tr>
                    <th class="p-3">Assessment</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Risk Level</th>
                    <th class="p-3">Due Date</th>
                    <th class="p-3">Action</th>
                </tr>
            </thead>

            <tbody>

            @foreach($assessments as $assessment)

                <tr class="border-t">

                    <td class="p-3">
                        {{ $assessment->assessment_name }}
                    </td>

                    <td class="p-3">
                        {{ $assessment->status }}
                    </td>

                    <td class="p-3">
                        {{ $assessment->risk_level ?? 'Pending' }}
                    </td>

                    <td class="p-3">
                        {{ \Carbon\Carbon::parse($assessment->due_date)->format('d M Y') }}
                    </td>

                    <td class="p-3">
                        <a href="{{ route('vendor.assessments.show', $assessment->id) }}"
                           class="bg-blue-600 text-white px-4 py-2 rounded-lg">
                            Open
                        </a>
                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection