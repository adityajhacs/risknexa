@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2>Framework Management</h2>
            <p class="text-muted">
                Manage compliance frameworks for vendor assessments.
            </p>
        </div>

        <a href="{{ route('frameworks.create') }}"
           class="btn btn-primary">

            + Create Framework

        </a>

    </div>

    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

    <table class="table table-bordered table-hover">

        <thead>

            <tr>

                <th>Code</th>

                <th>Name</th>

                <th>Version</th>

                <th>Status</th>

                <th>Action</th>

            </tr>

        </thead>

        <tbody>

        @forelse($frameworks as $framework)

            <tr>

                <td>{{ $framework->code }}</td>

                <td>{{ $framework->name }}</td>

                <td>{{ $framework->version }}</td>

                <td>{{ $framework->status }}</td>

               <td>

    <a href="{{ route('frameworks.edit', $framework) }}"
       class="btn btn-warning btn-sm">
        Edit
    </a>

    <form action="{{ route('frameworks.destroy', $framework) }}"
          method="POST"
          class="d-inline">

        @csrf
        @method('DELETE')

        <button type="submit"
                class="btn btn-danger btn-sm"
                onclick="return confirm('Are you sure you want to delete this framework?')">
            Delete
        </button>

    </form>

</td>

            </tr>

        @empty

            <tr>

                <td colspan="5" class="text-center">

                    No Framework Found

                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

    {{ $frameworks->links() }}

</div>

@endsection