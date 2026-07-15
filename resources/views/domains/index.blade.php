@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="card shadow-sm">

        <div class="card-header d-flex justify-content-between align-items-center">

            <div>
                <h3 class="mb-0">Domains</h3>
                <small class="text-muted">
                    Manage Framework Domains
                </small>
            </div>

            <a href="{{ route('domains.create') }}"
               class="btn btn-primary">

                <i class="bi bi-plus-circle"></i>

                Create Domain

            </a>

        </div>

        <div class="card-body">

            @if(session('success'))

                <div class="alert alert-success">

                    {{ session('success') }}

                </div>

            @endif

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">

                        <tr>

                            <th>#</th>

                            <th>Section</th>

                            <th>Code</th>

                            <th>Domain Name</th>

                            <th>Display Order</th>

                            <th>Status</th>

                            <th width="180">
                                Action
                            </th>

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

                                <a href="{{ route('domains.edit',$domain) }}"
                                   class="btn btn-warning btn-sm">

                                    Edit

                                </a>

                                <form
                                    action="{{ route('domains.destroy',$domain) }}"
                                    method="POST"
                                    class="d-inline">

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Delete this Domain?')">

                                        Delete

                                    </button>

                                </form>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="7"
                                class="text-center text-muted">

                                No Domains Found.

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-3">

                {{ $domains->links() }}

            </div>

        </div>

    </div>

</div>

@endsection