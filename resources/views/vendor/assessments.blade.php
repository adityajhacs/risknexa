<x-app-layout>

<div class="max-w-7xl mx-auto p-6">

    <h1 class="text-3xl font-bold mb-6">
        My Assessments
    </h1>

    <table class="w-full border">

        <thead class="bg-gray-100">
            <tr>
                <th class="p-3">Assessment</th>
                <th class="p-3">Status</th>
                <th class="p-3">Risk Level</th>
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
                    {{ $assessment->risk_level ?? '-' }}
                </td>
                <td class="p-3">

    <a
        href="{{ route('vendor.assessments.show', $assessment->id) }}"
        class="bg-blue-600 text-white px-3 py-1 rounded"
    >
        View
    </a>

</td>

            </tr>

        @endforeach

        </tbody>

    </table>

</div>

</x-app-layout>