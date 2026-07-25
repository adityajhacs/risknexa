
@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">

    <div class="flex justify-between items-center mb-6">

        <h1 class="text-3xl font-bold">
            Assessment Questions
        </h1>

        <a href="{{ route('assessment-questions.create') }}"
           class="bg-green-600 text-white px-4 py-2 rounded-lg">
            Assign New Question
        </a>

    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden">

        <table class="w-full">

            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3 text-left">Assessment</th>
                    <th class="p-3 text-left">Question</th>
                    <th class="p-3 text-left">Response</th>
                    <th class="p-3 text-left">Score</th>
                </tr>
            </thead>

            <tbody>

            @foreach($assessmentQuestions as $item)

            <tr class="border-t">

                <td class="p-3">
                    {{ $item->assessment->assessment_name }}
                </td>

                <td class="p-3">
                    {{ $item->question->question }}
                </td>

                <td class="p-3">
                    {{ $item->response ?? 'Not Answered' }}
                </td>

                <td class="p-3">
                    {{ $item->score ?? 0 }}
                </td>

            </tr>

            @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection