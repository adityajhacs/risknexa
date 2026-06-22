<x-app-layout>

<div class="max-w-7xl mx-auto p-6">

    <h1 class="text-3xl font-bold mb-6">
        {{ $assessment->assessment_name }}
    </h1>

    @foreach($questions as $question)

        <div class="border rounded p-4 mb-4">

            <h3 class="font-semibold">
                {{ $question->question }}
            </h3>

        </div>

    @endforeach

</div>

</x-app-layout>