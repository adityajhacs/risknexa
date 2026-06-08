<h1>{{ $vendor->vendor_name }}</h1>

<p>Email: {{ $vendor->email }}</p>
<p>Country: {{ $vendor->country }}</p>
<p>Status: {{ $vendor->status }}</p>

<hr>

<h2>Assessments</h2>

<table border="1">
    <tr>
        <th>Assessment</th>
        <th>Status</th>
        <th>Risk Score</th>
        <th>Risk Level</th>
    </tr>

    @foreach($vendor->assessments as $assessment)
    <tr>
        <td>{{ $assessment->assessment_name }}</td>
        <td>{{ $assessment->status }}</td>
        <td>{{ $assessment->risk_score }}</td>
        <td>{{ $assessment->risk_level }}</td>
    </tr>
    @endforeach
</table>