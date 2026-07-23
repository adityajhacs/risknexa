<div class="flex-1 bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">

    <form method="POST" action="{{ route('reviewers.save', $assessment->id) }}">

        @csrf

        <div class="border-b px-8 py-6">

            <h2 class="text-2xl font-bold text-slate-800">
                Assessment Questions
            </h2>

            <p class="text-slate-500 mt-1">
                Review vendor responses, provide comments and assign scores.
            </p>

        </div>

        <div class="p-8 space-y-8 max-h-[65vh] overflow-y-auto">

            @forelse($assessment->assessmentQuestions as $assessmentQuestion)

                <div class="border rounded-xl p-6">

                    <div class="flex justify-between">

                        <h3 class="font-bold text-lg">

                            Question {{ $loop->iteration }}

                        </h3>

                        <span class="text-sm text-slate-500">

                            {{ $assessmentQuestion->question->domain->name ?? 'General' }}

                        </span>

                    </div>

                    <p class="mt-4 text-slate-700">

                        {{ $assessmentQuestion->question->question }}

                    </p>

                    <div class="mt-6">

                        <label class="block text-sm font-semibold text-slate-600 mb-2">

                            Vendor Response

                        </label>

                        <div class="bg-slate-100 rounded-lg p-4">

                            {{ $assessmentQuestion->response ?? 'No response submitted.' }}

                        </div>

                    </div>

                    <div class="mt-6">

                        <label class="block text-sm font-semibold mb-2">

                            Reviewer Comment

                        </label>

                        <textarea
                            name="comments[{{ $assessmentQuestion->id }}]"
                            rows="3"
                            class="w-full border rounded-lg p-3">{{ $assessmentQuestion->reviewer_comment }}</textarea>

                    </div>

                    <div class="mt-6">

                        <label class="block text-sm font-semibold mb-2">

                            Score (0-10)

                        </label>

                        <input
                            type="number"
                            min="0"
                            max="10"
                            name="scores[{{ $assessmentQuestion->id }}]"
                            value="{{ $assessmentQuestion->score }}"
                            class="w-32 border rounded-lg p-2">

                    </div>

                </div>

            @empty

                <div class="text-center py-20 text-slate-500">

                    No questions assigned to this assessment.

                </div>

            @endforelse

        </div>

        <div class="border-t bg-slate-50 px-8 py-5 flex justify-end">

            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold">

                Save Review

            </button>

        </div>

    </form>

</div>