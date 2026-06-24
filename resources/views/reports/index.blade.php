<!DOCTYPE html>
<html>
<head>
    <title>Reports</title>

   @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <body class="bg-slate-50">

<div class="bg-white h-16 rounded-2xl shadow-sm border border-slate-200 mb-6 flex items-center justify-between px-6">
    ...
</div>

<div class="flex min-h-screen">

<aside class="w-64 bg-slate-900 text-white shadow-2xl border-r border-slate-800">
    ...
</aside>

<main class="flex-1 p-8">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
        <p class="text-slate-500">Total Reports</p>
        <h2 class="text-4xl font-bold mt-2">
            {{ $totalReports }}
        </h2>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
        <p class="text-slate-500">Approved Reports</p>
        <h2 class="text-4xl font-bold text-green-600 mt-2">
            {{ $approvedReports }}
        </h2>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
        <p class="text-slate-500">Pending Reviews</p>
        <h2 class="text-4xl font-bold text-yellow-500 mt-2">
            {{ $pendingReports }}
        </h2>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
        <p class="text-slate-500">High Risk Reports</p>
        <h2 class="text-4xl font-bold text-red-600 mt-2">
            {{ $highRiskReports }}
        </h2>
    </div>

</div>

<div class="max-w-7xl mx-auto p-8">
  <div class="mb-8">

    <h1 class="text-3xl font-bold text-slate-900">
        Reports Center
    </h1>

    <p class="text-slate-500 mt-2">
        Governance and assessment reporting dashboard
    </p>

</div>
<div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
    <table class="min-w-full">

       <thead class="bg-slate-50">

    <tr class="border-b hover:bg-slate-50 transition">

        <th class="text-left px-4 py-3 font-semibold">ID</th>
        <th class="text-left px-4 py-3 font-semibold">Vendor</th>
        <th class="text-left px-4 py-3 font-semibold">Assessment</th>
        <th class="text-left px-4 py-3 font-semibold">Risk Score</th>
        <th class="text-left px-4 py-3 font-semibold">Risk Level</th>
        <th class="text-left px-4 py-3 font-semibold">Review Status</th>
        <th class="text-left px-4 py-3 font-semibold">Action</th>

    </tr>

</thead>

        <tbody>

            @foreach($assessments as $assessment)

            <tr class="border-b hover:bg-slate-50 transition">

                <td class="px-4 py-4">{{ $assessment->id }}</td>    
               <td class="px-4 py-4">{{ $assessment->vendor->vendor_name }}</td>
                <td class="px-4 py-4">{{ $assessment->assessment_name }}</td>
                <td class="px-4 py-4">{{ $assessment->risk_score }}</td>
<td class="px-4 py-4">

    @if($assessment->risk_level == 'Low')

        <span class="px-3 py-1 rounded-full text-xs bg-green-100 text-green-800">
            Low
        </span>

    @elseif($assessment->risk_level == 'High')

        <span class="px-3 py-1 rounded-full text-xs bg-red-100 text-red-800">
            High
        </span>

    @elseif($assessment->risk_level == 'Critical')

        <span class="px-3 py-1 rounded-full text-xs bg-slate-900 text-white">
            Critical
        </span>

    @else

        <span class="px-3 py-1 rounded-full text-xs bg-yellow-100 text-yellow-800">
            Medium
        </span>

    @endif

</td>
               <td class="px-4 py-4">

@if($assessment->review_status == 'Approved')

    <span class="px-3 py-1 rounded-full text-xs bg-green-100 text-green-800">
        Approved
    </span>

@else

    <span class="px-3 py-1 rounded-full text-xs bg-yellow-100 text-yellow-800">
        Pending Review
    </span>

@endif

</td>

                <td>

                    <a href="{{ route('assessments.report', $assessment->id) }}"
                     class="inline-block px-3 py-2 rounded-lg bg-slate-900 text-white text-sm hover:bg-slate-700">

                        View Report

                    </a>

                </td>

            </tr>

            @endforeach

        </tbody>

    </table>
    </div>

</div>

</body>
</html>