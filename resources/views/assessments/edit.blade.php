<!DOCTYPE html>
<html>
<head>
    <title>Edit Assessment</title>
</head>
<body>

<h1>Edit Assessment</h1>

<form action="/assessments/{{ $assessment->id }}" method="POST">
    @csrf
    @method('PUT')

    <label>Vendor:</label>
    <select name="vendor_id">
        @foreach($vendors as $vendor)
            <option value="{{ $vendor->id }}"
                {{ $assessment->vendor_id == $vendor->id ? 'selected' : '' }}>
                {{ $vendor->vendor_name }}
            </option>
        @endforeach
    </select>

    <br><br>

    <label>Assessment Name:</label>
    <input type="text" name="assessment_name"
           value="{{ $assessment->assessment_name }}">

    <br><br>

    <label>Due Date:</label>
    <input type="date" name="due_date"
           value="{{ $assessment->due_date }}">

    <br><br>

    <label>Status:</label>
    <select name="status">
        <option value="Pending" {{ $assessment->status == 'Pending' ? 'selected' : '' }}>Pending</option>
        <option value="In Progress" {{ $assessment->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
        <option value="Completed" {{ $assessment->status == 'Completed' ? 'selected' : '' }}>Completed</option>
    </select>

    <br><br>

    <button type="submit">Update Assessment</button>

</form>

</body>
</html>