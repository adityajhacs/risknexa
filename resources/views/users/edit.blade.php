<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h2>Edit User</h2>

    <form method="POST"
          action="{{ route('users.update', $user->id) }}">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name</label>

            <input
                type="text"
                name="name"
                value="{{ $user->name }}"
                class="form-control">
        </div>

        <div class="mb-3">
            <label>Email</label>

            <input
                type="email"
                name="email"
                value="{{ $user->email }}"
                class="form-control">
        </div>

        <div class="mb-3">
            <label>Role</label>

            <select
                name="role"
                class="form-control">

                <option value="company_admin"
                    {{ $user->role == 'company_admin' ? 'selected' : '' }}>
                    Company Admin
                </option>

                <option value="vendor"
                    {{ $user->role == 'vendor' ? 'selected' : '' }}>
                    Vendor
                </option>

                <option value="reviewer"
                    {{ $user->role == 'reviewer' ? 'selected' : '' }}>
                    Reviewer
                </option>

            </select>

        </div>

        <button
            type="submit"
            class="btn btn-success">
            Update User
        </button>

    </form>

</div>

</body>
</html>