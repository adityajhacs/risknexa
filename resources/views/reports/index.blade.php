<!DOCTYPE html>
<html>
<head>
    <title>Reports</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h2 class="mb-4">
        Reports Module
    </h2>

    <table class="table table-bordered">

        <thead>

            <tr>

                <th>ID</th>
                <th>Vendor</th>
                <th>Assessment</th>
                <th>Risk Score</th>
                <th>Risk Level</th>
                <th>Review Status</th>
                <th>Action</th>

            </tr>

        </thead>

        <tbody>

            @foreach($assessments as $assessment)

            <tr>

                <td>{{ $assessment->id }}</td>

                <td>{{ $assessment->vendor->vendor_name }}</td>

                <td>{{ $assessment->assessment_name }}</td>

                <td>{{ $assessment->risk_score }}</td>

                <td>{{ $assessment->risk_level }}</td>

                <td>{{ $assessment->review_status }}</td>

                <td>

                    <a href="{{ route('assessments.report', $assessment->id) }}"
                       class="btn btn-primary btn-sm">

                        View Report

                    </a>

                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

</div>

</body>
</html>