<!DOCTYPE html>
<html>
<head>
    <title>Create User</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h2>Create User</h2>

    <form method="POST" action="{{ route('users.store') }}">
        @csrf

        <div class="mb-3">
            <label>Name</label>

            <input
                type="text"
                name="name"
                class="form-control">
        </div>

        <div class="mb-3">
            <label>Email</label>

            <input
                type="email"
                name="email"
                class="form-control">
        </div>

        <div class="mb-3">
            <label>Password</label>

            <input
                type="password"
                name="password"
                class="form-control">
        </div>

        <div class="mb-3">
            <label>Role</label>

            <select
                name="role"
                class="form-control">

                <option value="company_admin">
                    Company Admin
                </option>

                <option value="vendor">
                    Vendor
                </option>

                <option value="reviewer">
                    Reviewer
                </option>

            </select>

        </div>

        <button
            type="submit"
            class="btn btn-success">
            Save User
        </button>

    </form>

</div>

</body>
</html>