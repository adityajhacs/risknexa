@extends('layouts.vendor')

@section('content')

<div class="max-w-5xl mx-auto p-6">
<h1 class="text-3xl font-bold mb-4">
    Question History
</h1>

<div class="bg-blue-50 border border-blue-200 rounded-xl p-5 mb-8">

    <p class="text-sm text-slate-500 mb-2">
        Question
    </p>

   
    <p class="font-semibold text-slate-800">
    {{ $question->question }}
</p>
    

</div>

    @if($history->count() == 0)

        <div class="bg-white rounded-xl p-8 shadow">
            No history found.
        </div>


    @else


        @foreach($history as $item)
           @if($item->type == 'implementation_status_updated')

<div class="mt-5">

    <p class="font-semibold text-blue-700">
        Old Status
    </p>

    <div class="bg-blue-50 rounded-xl p-4 mt-2">
        {{ $item->old_answer ?? '-' }}
    </div>

</div>

<div class="mt-4">

    <p class="font-semibold text-indigo-700">
        New Status
    </p>

    <div class="bg-indigo-50 rounded-xl p-4 mt-2">
        {{ $item->new_answer ?? '-' }}
    </div>

</div>

@endif
        <div class="bg-white rounded-2xl shadow p-6 mb-6">

            <div class="flex justify-between items-start">

                <div>

                    <h2 class="font-bold text-lg text-slate-800">

                        {{ ucwords(str_replace('_',' ',$item->type)) }}

                    </h2>


                    <p class="text-slate-500 mt-1">

                        {{ optional($item->user)->name ?? 'Unknown User' }}

                    </p>

                </div>


                <div class="text-sm text-slate-500">

                    {{ $item->created_at->format('d M Y h:i A') }}

                </div>

            </div>

           

            @if($item->type == 'answer_updated')

                <div class="mt-5">

                    <p class="font-semibold text-red-600">
                        Old Answer
                    </p>

                    <div class="bg-red-50 rounded-xl p-4 mt-2">

                        {{ $item->old_answer ?? '-' }}

                    </div>

                </div>



                <div class="mt-4">

                    <p class="font-semibold text-green-600">
                        New Answer
                    </p>

                    <div class="bg-green-50 rounded-xl p-4 mt-2">

                        {{ $item->new_answer ?? '-' }}

                    </div>

                </div>

            @endif



            @if($item->type == 'evidence_uploaded')

                <div class="mt-5">

                    <p class="text-green-600 font-semibold">
                        Evidence Uploaded
                    </p>

                </div>

            @endif



            @if($item->type == 'evidence_deleted')

                <div class="mt-5">

                    <p class="text-red-600 font-semibold">
                        Evidence Deleted
                    </p>

                </div>

            @endif
           

        </div>


        @endforeach


    @endif



    <a
        href="{{ route('vendor.assessments.show',$assessment->id) }}"
        class="inline-block mt-8 px-6 py-3 bg-blue-600 text-white rounded-xl">

        Back

    </a>


</div>

@endsection