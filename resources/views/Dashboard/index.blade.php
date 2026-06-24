<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RiskNexa Dashboard</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            font-family: Inter, sans-serif;
        }
    </style>
</head>

<body class="bg-slate-50">
<div class="bg-white h-16 rounded-2xl shadow-sm border border-slate-200 mb-6 flex items-center justify-between px-6">
    <h2 class="font-semibold text-slate-800">
        RiskNexa Platform
    </h2>

    <div class="flex items-center gap-3">

    <div class="text-right">

        <p class="font-semibold text-slate-800">
            {{ auth()->user()->name }}
        </p>

        <p class="text-xs text-slate-500">
            System Administrator
        </p>

    </div>

    <div class="w-11 h-11 rounded-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white flex items-center justify-center font-bold shadow-md">
        {{ strtoupper(substr(auth()->user()->name,0,1)) }}
    </div>

</div>
    <form method="POST" action="{{ route('logout') }}">
    @csrf

    <button
        type="submit"
        class="bg-red-500 text-white px-4 py-2 rounded-xl text-sm font-medium hover:bg-red-600 transition">
        Logout
    </button>
</form>
</div>
<div class="flex min-h-screen">

    <!-- Sidebar -->

<aside class="w-64 bg-slate-900 text-white shadow-2xl border-r border-slate-800">
        <div class="p-6 border-b border-slate-800">

    <h1 class="text-3xl font-bold tracking-tight">
        RiskNexa
    </h1>

    <p class="text-slate-400 text-sm mt-2">
        Vendor Risk Platform
    </p>

    <div class="mt-4 text-xs uppercase tracking-widest text-slate-500">
        Governance & Compliance
    </div>

</div>

        <nav class="p-4 space-y-2">
            <p class="text-xs uppercase tracking-widest text-slate-500 px-4 mb-3">
    Main Menu
</p>

            <a href="/dashboard"
class="flex items-center gap-3 px-4 py-3 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg"
                <span>📊</span>
                <span>Dashboard</span>

            </a>

            <a href="/vendors"
               class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 hover:translate-x-1 transition-all duration-200">

                <span>👥</span>
                <span>Vendors</span>

            </a>

            <a href="/assessments"
               class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 hover:translate-x-1 transition-all duration-200">

                <span>📋</span>
                <span>Assessments</span>

            </a>

            <a href="/categories"
               class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 hover:translate-x-1 transition-all duration-200">

                <span>📂</span>
                <span>Categories</span>

            </a>

            <a href="/questions"
               class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 hover:translate-x-1 transition-all duration-200">

                <span>❓</span>
                <span>Questions</span>

            </a>

            <a href="/assessment-questions"
               class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 hover:translate-x-1 transition-all duration-200">

                <span>✅</span>
                <span>Assessment Questions</span>

            </a>
           <a href="/users"
   class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 hover:translate-x-1 transition-all duration-200">

    <span>👤</span>
    <span>Users</span>

</a>

<a href="/reports"
   class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 hover:translate-x-1 transition-all duration-200">

    <span>📄</span>
    <span>Reports</span>

</a>

        </nav>

    </aside>

    <!-- Main Content -->

    <main class="flex-1 p-8">

        <!-- Header -->

        

<div class="bg-gradient-to-r from-slate-900 via-blue-900 to-indigo-900 rounded-3xl p-8 text-white mb-8 shadow-2xl">

    <div class="flex justify-between items-center">

        <div>

            <p class="text-blue-200 text-sm uppercase tracking-widest">
                Enterprise Vendor Risk Management
            </p>

            <h1 class="text-5xl font-bold mt-3">
                Welcome Back,
                {{ auth()->user()->name }}
            </h1>

            <p class="mt-4 text-slate-300 text-lg">
                Manage vendors, assessments, governance and compliance
                from one centralized platform.
            </p>

        </div>

        <div class="hidden lg:block">

            <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-6">

              
<p class="text-slate-300 text-sm">
    Pending Reviews
</p>

<h2 class="text-4xl font-bold mt-2">
    {{ $pendingReviews }}
</h2>
<p class="text-yellow-300 mt-2">
    Requires Attention
</p>

                


            </div>

        </div>

    </div>

</div>

      <!-- Dashboard Overview -->

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

    <!-- Main Overview -->

    <div class="lg:col-span-2 bg-white rounded-3xl border border-slate-200 shadow-sm p-8">

        <div class="flex justify-between items-center mb-8">

            <div>

                <h2 class="text-2xl font-bold text-slate-900">
                    Dashboard Overview
                </h2>

                <p class="text-slate-500 mt-1">
                    Vendor risk and compliance summary
                </p>

            </div>

        </div>

        <div class="grid grid-cols-2 gap-6">

            <div class="border border-slate-200 rounded-2xl p-5">
                <p class="text-slate-500 text-sm">Total Vendors</p>
                <h3 class="text-3xl font-bold mt-2">{{ $totalVendors }}</h3>
            </div>

            <div class="border border-slate-200 rounded-2xl p-5">
                <p class="text-slate-500 text-sm">Assessments</p>
                <h3 class="text-3xl font-bold mt-2">{{ $totalAssessments }}</h3>
            </div>

            <div class="border border-slate-200 rounded-2xl p-5">
                <p class="text-slate-500 text-sm">Reports</p>
                <h3 class="text-3xl font-bold mt-2">{{ $reportsGenerated }}</h3>
            </div>

            <div class="border border-slate-200 rounded-2xl p-5">
                <p class="text-slate-500 text-sm">Pending Reviews</p>
                <h3 class="text-3xl font-bold mt-2 text-red-600">
                    {{ $pendingReviews }}
                </h3>
            </div>

        </div>

    </div>

    <!-- Compliance Card -->

    <div class="bg-gradient-to-br from-blue-600 to-indigo-700 rounded-3xl p-8 text-white">

        <p class="text-blue-100">
            Compliance Score
        </p>

        <h1 class="text-6xl font-bold mt-4">
            87%
        </h1>

        <p class="mt-4 text-blue-100">
            Strong compliance posture across vendors and assessments.
        </p>

        <div class="mt-8 border-t border-white/20 pt-4">

            <p class="text-sm">
                Approved Assessments
            </p>

            <h3 class="text-2xl font-bold">
                {{ $approvedAssessments }}
            </h3>

        </div>

    </div>

</div>
    <!-- Risk Analytics Cards -->

  <!-- Analytics Section -->

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

    <!-- Chart -->

    <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-200 p-6">

        <div class="flex justify-between items-center mb-6">

            <h2 class="text-xl font-bold text-slate-800">
                Assessment Analytics
            </h2>

            <span class="text-sm text-slate-500">
                Current Overview
            </span>

        </div>

        <div style="height:350px">

            <canvas id="assessmentChart"></canvas>

        </div>

    </div>

    <!-- Risk Overview -->

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">

        <h2 class="text-xl font-bold text-slate-800 mb-6">
            Risk Overview
        </h2>

        <div class="space-y-5">

            <div>
                <div class="flex justify-between mb-2">
                    <span>Low Risk</span>
                    <span class="font-semibold text-green-600">
                        {{ $lowRiskAssessments }}
                    </span>
                </div>

                <div class="w-full bg-slate-200 rounded-full h-3">
                    <div class="bg-green-500 h-3 rounded-full w-3/4"></div>
                </div>
            </div>

            <div>
                <div class="flex justify-between mb-2">
                    <span>Medium Risk</span>
                    <span class="font-semibold text-yellow-500">
                        {{ $mediumRiskAssessments }}
                    </span>
                </div>

                <div class="w-full bg-slate-200 rounded-full h-3">
                    <div class="bg-yellow-500 h-3 rounded-full w-1/2"></div>
                </div>
            </div>

            <div>
                <div class="flex justify-between mb-2">
                    <span>High Risk</span>
                    <span class="font-semibold text-red-500">
                        {{ $highRiskAssessments }}
                    </span>
                </div>

                <div class="w-full bg-slate-200 rounded-full h-3">
                    <div class="bg-red-500 h-3 rounded-full w-1/3"></div>
                </div>
            </div>

            <div>
                <div class="flex justify-between mb-2">
                    <span>Critical Risk</span>
                    <span class="font-semibold text-black">
                        {{ $criticalRiskAssessments }}
                    </span>
                </div>

                <div class="w-full bg-slate-200 rounded-full h-3">
                    <div class="bg-slate-900 h-3 rounded-full w-1/4"></div>
                </div>
            </div>

        </div>

    </div>

</div>
<div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mb-8">

    <h2 class="text-xl font-bold text-slate-800 mb-6">
        Quick Actions
    </h2>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

        <a href="/vendors/create"
           class="bg-blue-600 text-white p-4 rounded-xl text-center hover:bg-blue-700">
            + Vendor
        </a>

        <a href="/assessments/create"
           class="bg-green-600 text-white p-4 rounded-xl text-center hover:bg-green-700">
            + Assessment
        </a>

        <a href="/users/create"
           class="bg-purple-600 text-white p-4 rounded-xl text-center hover:bg-purple-700">
            + User
        </a>

        <a href="/reports"
           class="bg-slate-800 text-white p-4 rounded-xl text-center hover:bg-slate-900">
            View Reports
        </a>

    </div>

</div>



<!-- Recent Activities -->

<div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mb-8">

    <h2 class="text-xl font-bold text-slate-800 mb-6">
        Recent Activities
    </h2>
<p class="text-slate-500 text-sm mb-6">
    Latest platform activities and vendor events
</p>
    @forelse($recentActivities as $activity)

    <div class="flex items-start gap-4 py-4 border-b border-slate-100">

        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
            🔔
        </div>

        <div class="flex-1">

            <p class="font-semibold text-slate-800">
                {{ $activity->description }}
            </p>

            <p class="text-sm text-slate-500 mt-1">
                {{ $activity->created_at->diffForHumans() }}
            </p>

        </div>

    </div>

    @empty

    <p class="text-slate-500">
        No recent activities found.
    </p>

    @endforelse

</div>
<!-- Recent Assessments -->

<div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mb-8">

    <div class="flex justify-between items-center mb-6">

        <h2 class="text-xl font-bold text-slate-800">
            Recent Assessments
        </h2>

       

        <span class="text-sm text-slate-500">
            Latest Records
        </span>

    </div>

    <div class="overflow-x-auto">

        <table class="min-w-full">

            <thead class="bg-slate-50">

                <tr>

                    <th class="text-left px-4 py-3 font-semibold">
                        ID
                    </th>

                    <th class="text-left px-4 py-3 font-semibold">
                        Assessment Name
                    </th>

                    <th class="text-left px-4 py-3 font-semibold">
                        Status
                    </th>

                    <th class="text-left px-4 py-3 font-semibold">
                        Due Date
                    </th>
                    <th class="text-left px-4 py-3 font-semibold">
    Review Status
</th>
<th class="text-left px-4 py-3 font-semibold">
    Risk Level
</th>
<th class="text-left px-4 py-3 font-semibold">
    Action
</th>

                </tr>

            </thead>

            <tbody>

                @foreach($recentAssessments as $assessment)

                <tr class="border-b hover:bg-slate-50 transition">

                    <td class="px-4 py-4">
                        {{ $assessment->id }}
                    </td>

                    <td class="px-4 py-4 font-medium">
                        {{ $assessment->assessment_name }}
                    </td>

                    <td class="px-4 py-4">

                        @if($assessment->status == 'Pending')

                        <span class="px-3 py-1 rounded-full text-xs bg-yellow-100 text-yellow-800">
                            Pending
                        </span>

                        @elseif($assessment->status == 'Completed')

                        <span class="px-3 py-1 rounded-full text-xs bg-green-100 text-green-800">
                            Completed
                        </span>

                        @else

                        <span class="px-3 py-1 rounded-full text-xs bg-blue-100 text-blue-800">
                            {{ $assessment->status }}
                        </span>

                        @endif

                    </td>
             <td class="px-4 py-4">

    <a href="/assessments/{{ $assessment->id }}"
       class="px-3 py-2 rounded-lg bg-slate-900 text-white text-sm hover:bg-slate-700">

        View

    </a>

</td>


                    <td class="px-4 py-4">
                        {{ \Carbon\Carbon::parse($assessment->due_date)->format('d M Y') }}
                    </td>
                    <td class="px-4 py-4">

    @if($assessment->review_status == 'Approved')

        <span class="px-3 py-1 rounded-full text-xs bg-green-100 text-green-800">
            Approved
        </span>

    @elseif($assessment->review_status == 'Rejected')

        <span class="px-3 py-1 rounded-full text-xs bg-red-100 text-red-800">
            Rejected
        </span>

    @else

        <span class="px-3 py-1 rounded-full text-xs bg-yellow-100 text-yellow-800">
            Pending Review
        </span>

    @endif

</td>
<td class="px-4 py-4">

@if($assessment->risk_level == 'Low')

<span class="px-3 py-1 rounded-full text-xs bg-green-100 text-green-800">
    Low
</span>

@elseif($assessment->risk_level == 'Medium')

<span class="px-3 py-1 rounded-full text-xs bg-yellow-100 text-yellow-800">
    Medium
</span>

@elseif($assessment->risk_level == 'High')

<span class="px-3 py-1 rounded-full text-xs bg-red-100 text-red-800">
    High
</span>

@else

<span class="px-3 py-1 rounded-full text-xs bg-slate-900 text-white">
    Critical
</span>

@endif

</td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>


<script>

const ctx = document.getElementById('assessmentChart');

new Chart(ctx, {

    type: 'bar',

    data: {

        labels: [
            'Pending',
            'Completed',
            'Low Risk',
            'Medium Risk',
            'High Risk',
            'Critical'
        ],

        datasets: [{

            label: 'Assessment Metrics',

            data: [

                {{ $pendingAssessments }},
                {{ $completedAssessments }},
                {{ $lowRiskAssessments }},
                {{ $mediumRiskAssessments }},
                {{ $highRiskAssessments }},
                {{ $criticalRiskAssessments }}

            ],

            backgroundColor: [

                '#f59e0b',
                '#22c55e',
                '#16a34a',
                '#eab308',
                '#ef4444',
                '#0f172a'

            ]

        }]

    },

    options: {

        responsive: true,

        maintainAspectRatio: false,

        plugins: {

            legend: {

                display: false

            }

        },

        scales: {

            y: {

                beginAtZero: true

            }

        }

    }

});

</script>

</main>

</div>

</body>

</html>