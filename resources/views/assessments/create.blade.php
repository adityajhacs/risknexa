<!DOCTYPE html>
<html>
<head>
    <title>Create Assessment</title>
</head>
<body>

<h1>Create Assessment</h1>

<form action="/assessments" method="POST">
    @csrf

    <label>Vendor:</label>
    <select name="vendor_id">
        @foreach($vendors as $vendor)
            <option value="{{ $vendor->id }}">
                {{ $vendor->vendor_name }}
            </option>
        @endforeach
    </select>

    <br><br>

    <label>Assessment Name:</label>
    <input type="text" name="assessment_name">

    <br><br>

    <label>Due Date:</label>
    <input type="date" name="due_date">

    <br><br>

    <label>Status:</label>
    <select name="status">
        <option value="Pending">Pending</option>
        <option value="In Progress">In Progress</option>
        <option value="Completed">Completed</option>
    </select>

    <br><br>

    <button type="submit">Save Assessment</button>

</form>

</body>
</html>