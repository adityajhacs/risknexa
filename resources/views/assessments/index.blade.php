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
                    <th class="p-3 text-left">Vendor</th>
                    <th class="p-3 text-left">Assessment Name</th>
                    <th class="p-3 text-left">Due Date</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Risk Score</th>
                    <th class="p-3 text-left">Risk Level</th>
                    <th class="p-3 text-left">Action</th>
                </tr>
            </thead>

            <tbody>

            @foreach($assessments as $assessment)

            <tr class="border-t">

                <td class="p-3">{{ $assessment->vendor->vendor_name }}</td>

                <td class="p-3">{{ $assessment->assessment_name }}</td>

                <td class="p-3">{{ $assessment->due_date }}</td>

                <td class="p-3">{{ $assessment->status }}</td>

                <td class="p-3">{{ $assessment->risk_score ?? '-' }}</td>

                <td class="p-3">{{ $assessment->risk_level ?? '-' }}</td>

                <td class="p-3">

                    <div class="flex gap-2 flex-wrap">

                        <a href="/assessments/{{ $assessment->id }}"
                           class="bg-cyan-600 text-white px-3 py-1 rounded">
                            View
                        </a>

                        <a href="/assessments/{{ $assessment->id }}/edit"
                           class="bg-blue-600 text-white px-3 py-1 rounded">
                            Edit
                        </a>

                        <form action="/assessments/{{ $assessment->id }}"
                              method="POST">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="bg-red-600 text-white px-3 py-1 rounded">
                                Delete
                            </button>

                        </form>

                    </div>

                </td>

            </tr>

            @endforeach

            </tbody>

        </table>

    </div>

</div>

</body>
</html>