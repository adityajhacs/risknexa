@php

$response = $responses[$question->id] ?? null;

$isAnswered = $response && trim($response->answer ?? '') != '';

@endphp

<form
    method="POST"
    action="{{ route('vendor.assessments.saveQuestion', [$assessment->id,$question->id]) }}"
    enctype="multipart/form-data"
    class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mt-10 mb-8"
>

@csrf

<div class="flex justify-between items-center mb-5">

    <div>

        <h2 class="text-xl font-bold text-slate-800">

            Question {{ $index+1 }}

        </h2>

        <p class="text-slate-600 mt-2">

            {{ $question->question }}

        </p>

    </div>

    @if($isAnswered)

        <span
            class="px-4 py-1 rounded-full bg-green-100 text-green-700 text-sm font-semibold">

            Answered

        </span>

    @else

        <span
            class="px-4 py-1 rounded-full bg-orange-100 text-orange-700 text-sm font-semibold">

            Pending

        </span>

    @endif

</div>

<textarea
    name="answer"
    rows="5"
    class="w-full rounded-xl border border-slate-300 p-4 focus:ring-2 focus:ring-blue-500"
    placeholder="Write your answer here..."
    @if($isSubmitted) readonly @endif
>{{ old('answer',$response->answer ?? '') }}</textarea>

@if($response)

<div class="grid md:grid-cols-2 gap-6 mt-5">

<div>

<p class="text-xs uppercase text-slate-500">

Answer Updated By

</p>

<p class="font-semibold">

{{ optional($response->answerUpdatedBy)->name }}

</p>

</div>

<div>

<p class="text-xs uppercase text-slate-500">

Answer Updated On

</p>

<p class="font-semibold">

{{ $response->answer_updated_at
    ? \Carbon\Carbon::parse($response->answer_updated_at)->format('d M Y h:i A')
    : $response->updated_at->format('d M Y h:i A') }}
</p>

</div>

</div>

@endif

<div class="mt-6">

<label class="block text-sm font-semibold text-slate-700 mb-2">

Upload Evidence

</label>

@if(!$isSubmitted)

<input
type="file"
name="evidence"
class="block w-full border border-slate-300 rounded-xl p-3">

@endif

</div>

<div class="flex justify-end mt-8">

@unless($isSubmitted)

<button
type="submit"
class="px-8 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition">

Save Question

</button>

@endunless

</div>

</form>
@if($response && $response->evidence_file)

@php

$file = $response->evidence_file;

$extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));

@endphp

<div class="mt-6 rounded-2xl border border-slate-200 bg-slate-50 p-5">

    <h3 class="font-semibold text-slate-800 mb-4">

        Uploaded Evidence

    </h3>

    @if(in_array($extension,['jpg','jpeg','png','gif','webp']))

        <img
            src="{{ asset('storage/'.$file) }}"
            class="w-56 rounded-xl border shadow">

    @else

        <div class="rounded-xl bg-white border p-4">

            <p class="font-medium">

                {{ basename($file) }}

            </p>

            <p class="text-sm text-slate-500 mt-1">

                {{ strtoupper($extension) }} File

            </p>

        </div>

    @endif

    <div class="grid md:grid-cols-2 gap-6 mt-5">

        <div>

            <p class="text-xs uppercase text-slate-500">

                Evidence Uploaded By

            </p>

            <p class="font-semibold">

                {{ optional($response->evidenceUploadedBy)->name }}
            </p>

        </div>

        <div>

            <p class="text-xs uppercase text-slate-500">

                Evidence Uploaded On

            </p>

            <p class="font-semibold">

               {{ $response->evidence_uploaded_at
    ? \Carbon\Carbon::parse($response->evidence_uploaded_at)->format('d M Y h:i A')
    : $response->updated_at->format('d M Y h:i A') }}

            </p>

        </div>

    </div>

    <div class="flex flex-wrap gap-3 mt-6">

        <a
            href="{{ asset('storage/'.$file) }}"
            target="_blank"
            class="px-5 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700">

            View

        </a>

        <a
            href="{{ asset('storage/'.$file) }}"
            download
            class="px-5 py-2 border rounded-xl hover:bg-slate-100">

            Download

        </a>

    </div>
<div class="flex flex-wrap justify-between items-center mt-8 border-t pt-6">

    <div class="flex gap-3 flex-wrap">

      
        {{-- Delete Evidence --}}
        @if($response && $response->evidence_file && !$isSubmitted)

        <form
            method="POST"
            action="{{ route('vendor.assessments.deleteEvidence', [$assessment->id,$question->id]) }}"
            onsubmit="return confirm('Are you sure you want to delete this evidence?')">

            @csrf
            @method('DELETE')

            <button
                type="submit"
                class="px-5 py-2 bg-red-600 text-white rounded-xl hover:bg-red-700">

                Delete Evidence

            </button>

        </form>

        @endif


        {{-- View History --}}
        @if($response)

        <a
            href="{{ route('vendor.assessments.history',[$assessment->id,$question->id]) }}"
            class="px-5 py-2 border rounded-xl hover:bg-slate-100">

            View History

        </a>

        @endif

    </div>

</div>
</div>
@endif


