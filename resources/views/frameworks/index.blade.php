@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2>Domain Management</h2>
            <p class="text-muted">
                Manage framework domains for vendor assessments.
            </p>
        </div>

        <a href="{{ route('domains.create') }}"
           class="btn btn-primary">

            + Create Domain

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

                <th>#</th>

                <th>Section</th>

                <th>Code</th>

                <th>Domain Name</th>

                <th>Display Order</th>

                <th>Status</th>

                <th>Action</th>

            </tr>

        </thead>

        <tbody>

        @forelse($domains as $domain)

            <tr>

                <td>
                    {{ $loop->iteration }}
                </td>

                <td>
                    {{ $domain->category->name }}
                </td>

                <td>
                    {{ $domain->code }}
                </td>

                <td>
                    {{ $domain->name }}
                </td>

                <td>
                    {{ $domain->display_order }}
                </td>

                <td>

                    @if($domain->status == 'Active')

                        <span class="badge bg-success">

                            Active

                        </span>

                    @else

                        <span class="badge bg-danger">

                            Inactive

                        </span>

                    @endif

                </td>

                <td>

                    <a href="{{ route('domains.edit', $domain) }}"
                       class="btn btn-warning btn-sm">

                        Edit

                    </a>

                    <form action="{{ route('domains.destroy', $domain) }}"
                          method="POST"
                          class="d-inline">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this domain?')">

                            Delete

                        </button>

                    </form>

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="7" class="text-center">

                    No Domain Found

                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

    {{ $domains->links() }}

</div>

@endsection