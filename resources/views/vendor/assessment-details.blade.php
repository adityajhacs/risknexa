<x-app-layout>

<div class="max-w-7xl mx-auto p-6">

    <h1 class="text-3xl font-bold mb-6">
        {{ $assessment->assessment_name }}
    </h1>

    <form
    method="POST"
    action="{{ route('vendor.assessments.save', $assessment->id) }}"
    enctype="multipart/form-data"
>
    @csrf

        @foreach($questions as $question)

            <div class="border rounded p-4 mb-4">

                <h3 class="font-semibold mb-3">
                    {{ $question->question }}
                </h3>

               <textarea
    name="answers[{{ $question->id }}]"
    class="w-full border rounded p-2"
    rows="4"
></textarea>
<input
    type="file"
    name="evidence[{{ $question->id }}]"
    class="mt-2 block w-full border rounded p-2"
/>

            </div>

        @endforeach

        <button
            type="submit"
            class="bg-blue-600 text-white px-4 py-2 rounded"
        >
            Save Answers
        </button>
        <button
    type="submit"
    formaction="{{ route('vendor.assessments.submit', $assessment->id) }}"
    class="bg-green-600 text-white px-4 py-2 rounded ml-2"
>
    Submit Assessment
</button>

    </form>

</div>

</x-app-layout>