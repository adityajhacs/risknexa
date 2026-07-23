@extends('layouts.app')

@section('content')

<div class="h-[calc(100vh-120px)] flex gap-6">

    @include('reviewers.partials.sidebar')

    <div class="flex-1 flex flex-col">

        @include('reviewers.partials.header')

        @include('reviewers.partials.question-panel')

    </div>

</div>

@endsection