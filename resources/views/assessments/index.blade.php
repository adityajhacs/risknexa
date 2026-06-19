<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Assessments</title>
</head>

<body class="bg-gray-100">

<div class="max-w-7xl mx-auto p-6">

    <div class="flex justify-between items-center mb-6">

        <h1 class="text-3xl font-bold">
            All Assessments
        </h1>

        <a href="/assessments/create"
           class="bg-green-600 text-white px-4 py-2 rounded-lg">
            Create Assessment
        </a>

    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden">

        <table class="w-full">

            <thead class="bg-gray-200">
<tr>
    <th class="p-3 text-left">Assessment Name</th>
    <th class="p-3 text-left">Vendor</th>
    <th class="p-3 text-left">Framework</th>
    <th class="p-3 text-left">Status</th>
    <th class="p-3 text-left">Progress</th>
    <th class="p-3 text-left">Risk Score</th>
    <th class="p-3 text-left">Risk Level</th>
    <th class="p-3 text-left">Priority</th>
    <th class="p-3 text-left">Reviewer</th>
    <th class="p-3 text-left">Action</th>
</tr>
</thead>

            <tbody>

            @foreach($assessments as $assessment)

         <tr class="border-t">

    <td class="p-3">
        {{ $assessment->assessment_name }}
    </td>

    <td class="p-3">
        {{ $assessment->vendor->vendor_name }}
    </td>

   <td class="p-3">
    {{ $assessment->questionnaire }}
</td>
   <td class="p-3">

    @if($assessment->status == 'Completed')

        <span class="bg-green-100 text-green-700 px-2 py-1 rounded">
            Completed
        </span>

    @elseif($assessment->status == 'In Progress')

        <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded">
            In Progress
        </span>

    @else

        <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded">
            Draft
        </span>

    @endif

</td>

   <td class="p-3">

    @if($assessment->status == 'Completed')
        100%
    @elseif($assessment->status == 'In Progress')
        60%
    @else
        0%
    @endif

</td>

    <td class="p-3">
        {{ $assessment->risk_score ?? '-' }}
    </td>

    <td class="p-3">
        {{ $assessment->risk_level ?? '-' }}
    </td>
    <td class="p-3">



<td class="p-3">

@if($assessment->priority == 'Critical')

<span class="bg-red-100 text-red-700 px-2 py-1 rounded">
    Critical
</span>

@elseif($assessment->priority == 'High')

<span class="bg-orange-100 text-orange-700 px-2 py-1 rounded">
    High
</span>

@elseif($assessment->priority == 'Medium')

<span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded">
    Medium
</span>

@else

<span class="bg-green-100 text-green-700 px-2 py-1 rounded">
    Low
</span>

@endif

</td>

<td class="p-3">
    {{ $assessment->reviewer ?? '-' }}
</td>
    <td class="p-3">

        @if($assessment->status == 'Completed')

            <a href="/assessments/{{ $assessment->id }}"
               class="bg-green-600 text-white px-3 py-1 rounded">
                View
            </a>

        @else

            <a href="/assessments/{{ $assessment->id }}"
               class="bg-blue-600 text-white px-3 py-1 rounded">
                Open
            </a>

        @endif

    </td>

</tr>

            @endforeach

            </tbody>

        </table>

    </div>

</div>

</body>
</html>