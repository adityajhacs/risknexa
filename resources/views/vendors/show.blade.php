
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $vendor->vendor_name }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100 min-h-screen">

<div class="max-w-7xl mx-auto p-8">

    <!-- Hero Header -->

    <div class="bg-gradient-to-r from-indigo-600 via-blue-600 to-cyan-500 rounded-3xl p-8 text-white shadow-lg mb-8">

        <div class="flex justify-between items-center">

            <div>

                <h1 class="text-4xl font-bold">
                    {{ $vendor->vendor_name }}
                </h1>

                <p class="mt-3 text-blue-100">
                    Vendor Details, Risk Information & Assessment Overview
                </p>

            </div>

            @if($vendor->status == 'Active')

                <span class="px-5 py-2 rounded-full bg-green-500 text-white font-medium">
                    Active
                </span>

            @else

                <span class="px-5 py-2 rounded-full bg-red-500 text-white font-medium">
                    Inactive
                </span>

            @endif

        </div>

    </div>

    <!-- KPI Cards -->

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 shadow-lg hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">

            <div class="text-3xl mb-3">📧</div>

            <p class="text-slate-500 text-sm">
                Email
            </p>

            <h3 class="font-semibold text-slate-800 mt-2 break-all">
                {{ $vendor->email }}
            </h3>

        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">

            <div class="text-3xl mb-3">🌍</div>

            <p class="text-slate-500 text-sm">
                Country
            </p>

            <h3 class="font-semibold text-slate-800 mt-2">
                {{ $vendor->country }}
            </h3>

        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">

            <div class="text-3xl mb-3">📋</div>

            <p class="text-slate-500 text-sm">
                Total Assessments
            </p>

            <h3 class="text-3xl font-bold text-blue-600 mt-2">
                {{ $vendor->assessments->count() }}
            </h3>

        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">

            <div class="text-3xl mb-3">⚠️</div>

            <p class="text-slate-500 text-sm">
                High Risk
            </p>

            <h3 class="text-3xl font-bold text-red-600 mt-2">
                {{ $vendor->assessments->where('risk_level','High')->count() }}
            </h3>

        </div>

    </div>

    <!-- Risk Summary -->

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

        <div class="bg-green-50 border border-green-200 rounded-2xl p-6">
            <h4 class="text-green-700 font-medium">Low Risk</h4>
            <p class="text-3xl font-bold text-green-600 mt-2">
                {{ $vendor->assessments->where('risk_level','Low')->count() }}
            </p>
        </div>

        <div class="bg-yellow-50 border border-yellow-200 rounded-2xl p-6">
            <h4 class="text-yellow-700 font-medium">Medium Risk</h4>
            <p class="text-3xl font-bold text-yellow-600 mt-2">
                {{ $vendor->assessments->where('risk_level','Medium')->count() }}
            </p>
        </div>

        <div class="bg-red-50 border border-red-200 rounded-2xl p-6">
            <h4 class="text-red-700 font-medium">High Risk</h4>
            <p class="text-3xl font-bold text-red-600 mt-2">
                {{ $vendor->assessments->where('risk_level','High')->count() }}
            </p>
        </div>

        <div class="bg-slate-100 border border-slate-300 rounded-2xl p-6">
            <h4 class="text-slate-700 font-medium">Critical Risk</h4>
            <p class="text-3xl font-bold text-slate-900 mt-2">
                {{ $vendor->assessments->where('risk_level','Critical')->count() }}
            </p>
        </div>

    </div>

    <!-- Assessments Table -->

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">

        <div class="flex justify-between items-center mb-6">

            <h2 class="text-2xl font-bold text-slate-800">
                Assessments
            </h2>

            <span class="text-slate-500">
                {{ $vendor->assessments->count() }} Records
            </span>

        </div>

        <div class="overflow-x-auto">

            <table class="min-w-full">

                <thead class="bg-slate-50">

                    <tr>
                        <th class="text-left px-4 py-4">Assessment</th>
                        <th class="text-left px-4 py-4">Status</th>
                        <th class="text-left px-4 py-4">Risk Score</th>
                        <th class="text-left px-4 py-4">Risk Level</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($vendor->assessments as $assessment)

                    <tr class="border-b hover:bg-slate-50 transition">

                        <td class="px-4 py-4 font-medium">
                            {{ $assessment->assessment_name }}
                        </td>

                        <td class="px-4 py-4">

                            @if($assessment->status == 'Completed')

                                <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm">
                                    Completed
                                </span>

                            @elseif($assessment->status == 'Pending')

                                <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm">
                                    Pending
                                </span>

                            @else

                                <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-sm">
                                    {{ $assessment->status }}
                                </span>

                            @endif

                        </td>

                        <td class="px-4 py-4 font-semibold">
                            {{ $assessment->risk_score }}
                        </td>

                        <td class="px-4 py-4">

                            @if($assessment->risk_level == 'Critical')

                                <span class="text-black font-semibold">
                                    Critical
                                </span>

                            @elseif($assessment->risk_level == 'High')

                                <span class="text-red-600 font-semibold">
                                    High
                                </span>

                            @elseif($assessment->risk_level == 'Medium')

                                <span class="text-yellow-600 font-semibold">
                                    Medium
                                </span>

                            @else

                                <span class="text-green-600 font-semibold">
                                    Low
                                </span>

                            @endif

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="4" class="text-center py-10 text-slate-500">
                            No assessments found.
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

</body>
</html>
