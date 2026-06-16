<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Upload Evidence</title>
</head>

<body class="bg-gray-100">

<div class="max-w-2xl mx-auto p-6">

    <div class="bg-white shadow-lg rounded-lg p-6">

        <h1 class="text-3xl font-bold mb-6">
            Upload Evidence
        </h1>

        <p class="mb-4 text-gray-600">
            Assessment:
            <strong>
                {{ $assessment->assessment_name }}
            </strong>
        </p>

        <form
            action="/assessments/{{ $assessment->id }}/evidence"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf

            <div class="mb-4">

                <label class="block font-medium mb-2">
                    Select File
                </label>

                <input
                    type="file"
                    name="document"
                    class="w-full border rounded p-2"
                    required
                >

            </div>

            <button
                type="submit"
                class="bg-blue-600 text-white px-5 py-2 rounded"
            >
                Upload Evidence
            </button>

        </form>

    </div>

</div>

</body>
</html>