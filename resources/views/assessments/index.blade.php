<!DOCTYPE html>
<html>
<head>
    <title>Assessments List</title>

</head>

<body>

<h1>All Assessments</h1>

<a href="/assessments/create">Create Assessment</a>

<br><br>

<table border="1" cellpadding="10">
    <tr>
        <th>Vendor ID</th>
        <th>Assessment Name</th>
        <th>Due Date</th>
        <th>Status</th>
        <th>Risk Score</th>
<th>Risk Level</th>
<th>Action</th>
    </tr>

    @foreach($assessments as $assessment)
    <tr>
        <td>{{ $assessment->vendor->vendor_name }}</td>
        <td>{{ $assessment->assessment_name }}</td>
        <td>{{ $assessment->due_date }}</td>
        <td>{{ $assessment->status }}</td>
        <td>{{ $assessment->risk_score ?? '-' }}</td>
<td>{{ $assessment->risk_level ?? '-' }}</td>

        <td>
             <a href="/assessments/{{ $assessment->id }}" class="btn btn-info btn-sm">
        View
    </a>|
    
    <a href="/assessments/{{ $assessment->id }}/edit">Edit</a>|
    
    <form action="/assessments/{{ $assessment->id }}" method="POST" style="display: inline;">
    @csrf
    @method('DELETE')

    <button type="submit">Delete</button>
</form>
</td>

    </tr>
    @endforeach

</table>

</body>
</html>