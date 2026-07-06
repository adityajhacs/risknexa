<x-app-layout>

<div class="max-w-5xl mx-auto p-6">

<h1 class="text-3xl font-bold mb-8">

Question {{ $question }} History

</h1>

@if($history->count()==0)

<div class="bg-white rounded-xl p-8 shadow">

No history found.

</div>

@else

@foreach($history as $item)

<div class="bg-white rounded-2xl shadow p-6 mb-6">

<div class="flex justify-between">

<div>

<h2 class="font-bold text-lg">

{{ ucwords(str_replace('_',' ',$item->type)) }}

</h2>

<p class="text-slate-500">

{{ optional($item->user)->name }}

</p>

</div>

<div class="text-sm text-slate-500">

{{ $item->created_at->format('d M Y h:i A') }}

</div>

</div>

@if($item->type=='answer_updated')

<div class="mt-5">

<p class="font-semibold text-red-600">

Old Answer

</p>

<div class="bg-red-50 rounded-xl p-4">

{{ $item->old_answer }}

</div>

</div>

<div class="mt-4">

<p class="font-semibold text-green-600">

New Answer

</p>

<div class="bg-green-50 rounded-xl p-4">

{{ $item->new_answer }}

</div>

</div>

@endif

@if($item->type=='evidence_uploaded')

<div class="mt-5">

<p class="text-green-600 font-semibold">

Evidence Uploaded

</p>

</div>

@endif

@if($item->type=='evidence_deleted')

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

</x-app-layout>