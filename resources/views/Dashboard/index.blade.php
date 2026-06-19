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

    <div class="flex items-center gap-4">
        <span class="text-slate-500">Admin</span>
        <div class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center">
            A
        </div>
    </div>
</div>
<div class="flex min-h-screen">

    <!-- Sidebar -->

    <aside class="w-72 bg-slate-900 text-white shadow-2xl">

        <div class="p-6 border-b border-slate-700">

            <h1 class="text-3xl font-bold">
                RiskNexa
            </h1>

            <p class="text-slate-400 text-sm mt-2">
                Vendor Risk Platform
            </p>

        </div>

        <nav class="p-4 space-y-2">

            <a href="/dashboard"
               class="flex items-center gap-3 px-4 py-3 rounded-xl bg-blue-600 text-white">

                <span>📊</span>
                <span>Dashboard</span>

            </a>

            <a href="/vendors"
               class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition">

                <span>👥</span>
                <span>Vendors</span>

            </a>

            <a href="/assessments"
               class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition">

                <span>📋</span>
                <span>Assessments</span>

            </a>

            <a href="/categories"
               class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition">

                <span>📂</span>
                <span>Categories</span>

            </a>

            <a href="/questions"
               class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition">

                <span>❓</span>
                <span>Questions</span>

            </a>

            <a href="/assessment-questions"
               class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition">

                <span>✅</span>
                <span>Assessment Questions</span>

            </a>

        </nav>

    </aside>

    <!-- Main Content -->

    <main class="flex-1 p-8">

        <!-- Header -->

        <div class="flex justify-between items-center mb-8">

            <div>

                <h1 class="text-4xl font-bold text-slate-800">
                    Dashboard
                </h1>

                <p class="text-slate-500 mt-2">
                    Monitor vendors, assessments and compliance posture
                </p>

            </div>

            <button
                class="bg-blue-600 text-white px-6 py-3 rounded-xl shadow hover:bg-blue-700 transition">

                + New Assessment

            </button>

        </div>

        <!-- Compliance Score -->

        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-3xl p-8 text-white mb-8 shadow-lg">

            <p class="text-blue-100 text-lg">
                Compliance Score
            </p>

            <h1 class="text-6xl font-bold mt-2">
                87%
            </h1>

            <p class="mt-3 text-blue-100">
                Strong compliance posture across vendors and assessments.
            </p>

        </div>

        <!-- KPI Cards -->

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">

    <!-- Total Vendors -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-xl hover:-translate-y-1 transition duration-300">
        <p class="text-slate-500">Total Vendors</p>
        <h2 class="text-4xl font-bold mt-2">{{ $totalVendors }}</h2>
    </div>

    <!-- Active Vendors -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-xl hover:-translate-y-1 transition duration-300">
        <p class="text-slate-500">Active Vendors</p>
        <h2 class="text-4xl font-bold text-green-600 mt-2">
            {{ $activeVendors }}
        </h2>
    </div>

    <!-- Inactive Vendors -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-xl hover:-translate-y-1 transition duration-300">
        <p class="text-slate-500">Inactive Vendors</p>
        <h2 class="text-4xl font-bold text-slate-600 mt-2">
            {{ $inactiveVendors }}
        </h2>
    </div>

    <!-- High Risk Vendors -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-xl hover:-translate-y-1 transition duration-300">
        <p class="text-slate-500">High Risk Vendors</p>
        <h2 class="text-4xl font-bold text-red-600 mt-2">
            {{ $highRiskVendors }}
        </h2>
    </div>

    <!-- Total Assessments -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-xl hover:-translate-y-1 transition duration-300">
        <p class="text-slate-500">Total Assessments</p>
        <h2 class="text-4xl font-bold text-blue-600 mt-2">
            {{ $totalAssessments }}
        </h2>
    </div>

    <!-- Pending -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-xl hover:-translate-y-1 transition duration-300">
        <p class="text-slate-500">Pending Assessments</p>
        <h2 class="text-4xl font-bold text-yellow-500 mt-2">
            {{ $pendingAssessments }}
        </h2>
    </div>

    <!-- Completed -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-xl hover:-translate-y-1 transition duration-300">
        <p class="text-slate-500">Completed Assessments</p>
        <h2 class="text-4xl font-bold text-green-600 mt-2">
            {{ $completedAssessments }}
        </h2>
    </div>

    <!-- Compliance -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-xl hover:-translate-y-1 transition duration-300">
        <p class="text-slate-500">Compliance Score</p>
        <h2 class="text-4xl font-bold text-indigo-600 mt-2">
            87%
        </h2>
    </div>
<!-- Pending Reviews -->
<div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-xl hover:-translate-y-1 transition duration-300">
    <p class="text-slate-500">Pending Reviews</p>
    <h2 class="text-4xl font-bold text-yellow-600 mt-2">
        {{ $pendingReviews }}
    </h2>
</div>

<!-- Approved -->
<div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-xl hover:-translate-y-1 transition duration-300">
    <p class="text-slate-500">Approved Assessments</p>
    <h2 class="text-4xl font-bold text-green-600 mt-2">
        {{ $approvedAssessments }}
    </h2>
</div>

<!-- Rejected -->
<div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-xl hover:-translate-y-1 transition duration-300">
    <p class="text-slate-500">Rejected Assessments</p>
    <h2 class="text-4xl font-bold text-red-600 mt-2">
        {{ $rejectedAssessments }}
    </h2>
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