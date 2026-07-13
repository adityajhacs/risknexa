@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="card shadow-sm">

        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Create Framework</h4>

            <a href="{{ route('frameworks.index') }}" class="btn btn-secondary">
                Back
            </a>
        </div>

        <div class="card-body">

            <form action="{{ route('frameworks.store') }}" method="POST">

                @csrf

                @include('frameworks._form')

            </form>

        </div>

    </div>

</div>

@endsection