<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Assign Question</title>
</head>

<body class="bg-gray-100">

<div class="max-w-2xl mx-auto p-6">

    <div class="bg-white shadow-lg rounded-lg p-6">

        <h1 class="text-3xl font-bold mb-6">
            Assign Question
        </h1>

        <form action="{{ route('assessment-questions.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block font-medium mb-1">
                    Assessment
                </label>

                <select name="assessment_id"
                        class="w-full border rounded p-2">

                    @foreach($assessments as $assessment)
                        <option value="{{ $assessment->id }}">
                            {{ $assessment->assessment_name }}
                        </option>
                    @endforeach

                </select>
            </div>

            <div class="mb-6">
                <label class="block font-medium mb-1">
                    Question
                </label>

                <select name="question_id"
                        class="w-full border rounded p-2">

                    @foreach($questions as $question)
                        <option value="{{ $question->id }}">
                            {{ $question->question }}
                        </option>
                    @endforeach

                </select>
            </div>

            <button type="submit"
                    class="bg-blue-600 text-white px-5 py-2 rounded">
                Assign Question
            </button>

        </form>

    </div>

</div>

</body>
</html>