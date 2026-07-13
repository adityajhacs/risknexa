@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto p-6">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">

        <div>
            <p class="text-sm text-gray-500">
                Vendor Assessments / List
            </p>

            <h1 class="text-3xl font-bold text-gray-800">
                Vendor Assessments
            </h1>
        </div>

        <a href="/assessments/create"
           class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow">
            New Assessment
        </a>

    </div>

    <!-- Search -->
    <div class="flex justify-end mb-4">

        <input type="text"
               placeholder="Search Assessment"
               class="border border-gray-300 rounded-lg px-4 py-2 w-64 focus:outline-none focus:ring-2 focus:ring-blue-500">

    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">

        <table class="w-full">

            <thead class="bg-gray-50 text-gray-600 uppercase text-sm">

                <tr>
                    <th class="p-4 text-left">Vendor</th>
                    <th class="p-4 text-left">Assessment</th>
                    <th class="p-4 text-left">Due Date</th>
                    <th class="p-4 text-left">Status</th>
                    <th class="p-4 text-left">Risk Score</th>
                    <th class="p-4 text-left">Risk Level</th>
                    <th class="p-4 text-left">Action</th>
                </tr>

            </thead>

            <tbody>

            @foreach($assessments as $assessment)

                <tr class="border-t hover:bg-gray-50 transition">

                    <td class="p-4">
                        {{ $assessment->vendor->vendor_name ?? 'Vendor Not Found' }}
                    </td>

                    <td class="p-4 font-medium text-gray-700">
                        {{ $assessment->assessment_name }}
                    </td>

                    <td class="p-4">
                        {{ $assessment->due_date }}
                    </td>

                    <td class="p-4">

                        @if($assessment->status == 'Completed')

                            <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                                Completed
                            </span>

                        @elseif($assessment->status == 'In Progress')

                            <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-semibold">
                                In Progress
                            </span>

                        @else

                            <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-semibold">
                                Pending
                            </span>

                        @endif

                    </td>

                    <td class="p-4 font-semibold">
                        {{ $assessment->risk_score ?? '-' }}
                    </td>

                    <td class="p-4">

                        @if($assessment->risk_level == 'Low')

                            <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                                Low
                            </span>

                        @elseif($assessment->risk_level == 'Medium')

                            <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-semibold">
                                Medium
                            </span>

                        @elseif($assessment->risk_level == 'High')

                            <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-semibold">
                                High
                            </span>

                        @elseif($assessment->risk_level == 'Critical')

                            <span class="px-3 py-1 rounded-full bg-red-600 text-white text-xs font-semibold">
                                Critical
                            </span>

                        @else

                            <span class="text-gray-500">
                                -
                            </span>

                        @endif

                    </td>

                    <td class="p-4">

                        <a href="/assessments/{{ $assessment->id }}"
                           class="bg-sky-500 hover:bg-sky-600 text-white px-3 py-1 rounded-lg">
                            View
                        </a>

                        <a href="/assessments/{{ $assessment->id }}/edit"
                           class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-lg">
                            Edit
                        </a>

                        <form action="/assessments/{{ $assessment->id }}"
                              method="POST"
                              class="inline-block">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg">
                                Delete
                            </button>

                        </form>

                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection