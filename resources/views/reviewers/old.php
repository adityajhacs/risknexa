@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-6">

    <h1 class="text-3xl font-bold mb-6">
        Review Assessment
    </h1>

    {{-- Assessment Summary --}}
    <div class="bg-white rounded-xl shadow p-6 mb-6">

        <h2 class="text-xl font-semibold mb-4">
            Assessment Details
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            <div>
                <span class="font-semibold">Assessment Name</span>
                <p>{{ $assessment->assessment_name }}</p>
            </div>

            <div>
                <span class="font-semibold">Vendor</span>
                <p>{{ $assessment->vendor->vendor_name }}</p>
            </div>

            <div>
                <span class="font-semibold">Framework</span>
                <p>{{ $assessment->framework->name ?? 'N/A' }}</p>
            </div>

            <div>
                <span class="font-semibold">Priority</span>
                <p>{{ $assessment->priority }}</p>
            </div>

            <div>
                <span class="font-semibold">Review Status</span>
                <p>{{ $assessment->review_status }}</p>
            </div>

            <div>
                <span class="font-semibold">Due Date</span>
                <p>{{ \Carbon\Carbon::parse($assessment->due_date)->format('d M Y') }}</p>
            </div>

        </div>

    </div>
  <form action="{{ route('reviewers.save', $assessment->id) }}" method="POST">
    @csrf
    {{-- Vendor Responses --}}
    <div class="bg-white rounded-xl shadow p-6">

        <h2 class="text-xl font-bold mb-6">
            Vendor Responses
        </h2>

      @forelse($groupedQuestions as $domainName => $questions)

<div class="bg-gray-100 rounded-lg p-4 mb-6">
    <h2 class="text-xl font-bold text-blue-700">
        {{ $domainName }}
    </h2>
</div>

@foreach($questions as $assessmentQuestion)

{{-- Existing Question Card --}}

@endforeach

@endforelse

            <div class="border rounded-xl p-5 mb-6">

                <h3 class="font-bold text-lg mb-3">
                    Q{{ $loop->iteration }}.
                    {{ $assessmentQuestion->question->question_text }}
                </h3>

                {{-- Vendor Response --}}
                <div class="mb-4">

                    <label class="font-semibold">
                        Vendor Response
                    </label>

                    <div class="bg-gray-100 rounded-lg p-3 mt-2">

                        {{ $assessmentQuestion->response ?? 'Not Answered' }}

                    </div>

                </div>

                {{-- Evidence Placeholder --}}
                <div class="mb-4">

                    <label class="font-semibold">
                        Uploaded Evidence
                    </label>

                    <div class="bg-blue-50 border rounded-lg p-3 mt-2 text-gray-600">

                        Evidence Integration Coming Next

                    </div>

                </div>

                {{-- Reviewer Comment --}}
                <div class="mb-4">

                    <label class="font-semibold">
                        Reviewer Comment
                    </label>

                  <textarea
    name="questions[{{ $assessmentQuestion->id }}][comment]"
    rows="3"
    class="w-full border rounded-lg p-3 mt-2"
    placeholder="Write your observation..."
>{{ old('questions.'.$assessmentQuestion->id.'.comment', $assessmentQuestion->reviewer_comment) }}</textarea>

                </div>

                {{-- Score --}}
                <div class="mb-4">

                    <label class="font-semibold">
                        Score (0-10)
                    </label>

                    <input
    type="number"
    name="questions[{{ $assessmentQuestion->id }}][score]"
    min="0"
    max="10"
    value="{{ old('questions.'.$assessmentQuestion->id.'.score', $assessmentQuestion->score) }}"
    class="border rounded-lg p-2 mt-2 w-32"
>

                </div>

            </div>

        @empty

            <div class="text-center text-gray-500 py-10">

                No Questions Found

            </div>

        @endforelse

    </div>

    {{-- Final Review --}}
    <div class="bg-white rounded-xl shadow p-6 mt-6">

        <h2 class="text-xl font-bold mb-5">
            Final Decision
        </h2>

        <div class="mb-5">

            <label class="font-semibold">
                Overall Remarks
            </label>

           <textarea
    name="overall_remarks"
    rows="4"
    class="w-full border rounded-lg p-3 mt-2"
    placeholder="Overall review remarks..."
>{{ old('overall_remarks', $assessment->overall_remarks) }}</textarea>

        </div>

        <div class="flex justify-end">

    <button
        type="submit"
        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg">
        Save Review
    </button>

</div>

    </div>
</form>
</div>

@endsection