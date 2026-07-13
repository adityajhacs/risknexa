@extends('layouts.app')

@section('content')

<div class="container mt-5">

    <h2 class="mb-4">
        User Management
    </h2>
    <a href="{{ route('users.create') }}"
   class="btn btn-primary mb-3">
    Create User
</a>

    <table class="table table-bordered">

        <thead>

            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>

        </thead>

        <tbody>

            @foreach($users as $user)

                <tr>

                    <td>{{ $user->id }}</td>

                    <td>{{ $user->name }}</td>

                    <td>{{ $user->email }}</td>

                    <td>{{ $user->role }}</td>
                    <td>
                    <a href="{{ route('users.edit', $user->id) }}"
       class="btn btn-warning btn-sm">
        Edit
    </a>
    <form action="{{ route('users.destroy', $user->id) }}"
      method="POST"
      style="display:inline;">

    @csrf
    @method('DELETE')

    <button
        type="submit"
        class="btn btn-danger btn-sm">
        Delete
    </button>

</form>
</td>

                </tr>
                

            @endforeach

        </tbody>

    </table>

</div>

@endsection