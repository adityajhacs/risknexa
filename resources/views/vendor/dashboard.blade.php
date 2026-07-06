@extends('layouts.vendor')

@section('content')

<div class="p-8 space-y-8">

    @include('vendor.partials.hero')

    @include('vendor.partials.stats')

    

    <div class="lg:col-span-2 space-y-6">

        @include('vendor.partials.recent-assessments')

        @include('vendor.partials.compliance')

        @include('vendor.partials.quick-actions')

    </div>

    <div>

        @include('vendor.partials.team-members')

    </div>

</div>
</div>

@endsection