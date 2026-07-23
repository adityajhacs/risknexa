@extends('layouts.app')

@section('content')

<div class="container mx-auto p-6">

    <h1 class="text-3xl font-bold mb-6">
        Reviewer Dashboard
    </h1>

    <div class="bg-white rounded-xl shadow p-6">

        <h2 class="text-xl font-semibold mb-4">
            Assigned Assessments
        </h2>
   @forelse($assessments as $assessment)

    <div class="border-b py-3">

        <strong>{{ $assessment->assessment_name }}</strong>

        <br>

        Vendor ID :
        {{ $assessment->vendor_id }}

        <br><br>

       <a href="{{ route('reviewers.assessment.overview', $assessment->id) }}"
   class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
    Review Assessment
</a>
    </div>

@empty

    <p>No Assessment Assigned.</p>

@endforelse
       
    </div>

</div>

@endsection