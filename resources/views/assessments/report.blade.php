<!DOCTYPE html>
<html>
<head>
    <title>Assessment Report</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-dark text-white">
            <h2>Risk Assessment Report</h2>
        </div>

        <div class="card-body">
<div class="alert alert-primary mb-4">

    <h4>
        Executive Summary
    </h4>

    <p>

        Vendor
        <strong>{{ $assessment->vendor->vendor_name }}</strong>

        completed

        <strong>{{ $answeredQuestions }}</strong>

        out of

        <strong>{{ $totalQuestions }}</strong>

        questions.

        Risk Level:

        <strong>{{ $assessment->risk_level }}</strong>

        with Risk Score

        <strong>{{ $assessment->risk_score }}</strong>.

    </p>

</div>
            <table class="table table-bordered">

                <tr>
                    <th>Assessment ID</th>
                    <td>{{ $assessment->id }}</td>
                </tr>

                <tr>
                    <th>Assessment Name</th>
                    <td>{{ $assessment->assessment_name }}</td>
                </tr>

                <tr>
                    <th>Vendor</th>
                    <td>{{ $assessment->vendor->vendor_name }}</td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td>{{ $assessment->status }}</td>
                </tr>

                <tr>
                    <th>Review Status</th>
                    <td>{{ $assessment->review_status }}</td>
                </tr>

                <tr>
                    <th>Governance Outcome</th>
                    <td>{{ $assessment->governance_outcome ?? 'Pending' }}</td>
                </tr>

                <tr>
                    <th>Risk Score</th>
                    <td>{{ $assessment->risk_score }}</td>
                </tr>

                <tr>
                    <th>Risk Level</th>
                   <td>

@if($assessment->risk_level == 'Low')

<span class="badge bg-success">
    Low
</span>

@elseif($assessment->risk_level == 'Medium')

<span class="badge bg-warning">
    Medium
</span>

@elseif($assessment->risk_level == 'High')

<span class="badge bg-danger">
    High
</span>

@else

<span class="badge bg-dark">
    Critical
</span>

@endif

</td>
                </tr>
                <tr>
    <th>Governance Recommendation</th>
    <td>

        @if($assessment->risk_level == 'Low')

            <span class="badge bg-success">
                {{ $recommendation }}
            </span>

        @elseif($assessment->risk_level == 'Medium')

            <span class="badge bg-warning">
                {{ $recommendation }}
            </span>

        @elseif($assessment->risk_level == 'High')

            <span class="badge bg-danger">
                {{ $recommendation }}
            </span>

        @else

            <span class="badge bg-dark">
                {{ $recommendation }}
            </span>

        @endif

    </td>
</tr>

                <tr>
                    <th>Generated On</th>
                    <td>{{ now() }}</td>
                </tr>
                <tr>
    <th>Total Questions</th>
    <td>{{ $totalQuestions }}</td>
</tr>

<tr>
    <th>Answered Questions</th>
    <td>{{ $answeredQuestions }}</td>
</tr>

<tr>
    <th>Evidence Files</th>
    <td>{{ $evidenceCount }}</td>
</tr>

            </table>
            <h3 class="mt-4 mb-3">
    Question Responses
</h3>

<table class="table table-bordered">

    <thead>
        <tr>
            <th>Question</th>
            <th>Response</th>
            <th>Score</th>
        </tr>
    </thead>

    <tbody>

    @foreach($questionResponses as $response)

        <tr>

            <td>
                {{ $response->question->question_text }}
            </td>

            <td>
                {{ $response->response ?? 'Not Answered' }}
            </td>

            <td>
                {{ $response->score ?? 0 }}
            </td>

        </tr>

    @endforeach

    </tbody>

</table>

            <a href="/assessments/{{ $assessment->id }}"
               class="btn btn-secondary">
                Back
            </a>

        </div>

    </div>

</div>

</body>
</html>