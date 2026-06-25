<!DOCTYPE html>
<html>
<head>
    <title>Vendor Dashboard</title>
</head>
<body>

<h2>My Assessments</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Assessment</th>
        <th>Status</th>
        <th>Due Date</th>
    </tr>

    @foreach($assessments as $assessment)
        <tr>
            <td>{{ $assessment->id }}</td>
            <td>{{ $assessment->assessment_name }}</td>
            <td>{{ $assessment->status }}</td>
            <td>{{ $assessment->due_date }}</td>
            <td>
    <a href="{{ route('vendor.assessment.show', $assessment->id) }}">
        Open
    </a>
</td>
        </tr>
    @endforeach

</table>

</body>
</html>