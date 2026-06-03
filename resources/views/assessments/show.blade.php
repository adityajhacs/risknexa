<!DOCTYPE html>
<html>
<head>
    <title>Assessment Details</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">
            <h3>Assessment Details</h3>
        </div>

        <div class="card-body">

            <p>
                <strong>ID:</strong>
                {{ $assessment->id }}
            </p>

            <p>
                <strong>Assessment Name:</strong>
                {{ $assessment->assessment_name }}
            </p>

            <p>
                <strong>Vendor:</strong>
                {{ $assessment->vendor->vendor_name }}
            </p>

            <p>
                <strong>Due Date:</strong>
                {{ $assessment->due_date }}
            </p>

            <p>
                <strong>Status:</strong>
                {{ $assessment->status }}
            </p>

            <hr>

            <p>
                <strong>Risk Score:</strong>
                {{ $riskScore }}
            </p>

            <p>
                <strong>Risk Level:</strong>

                @if($riskLevel == 'Low')
                    <span class="badge bg-success">
                        {{ $riskLevel }}
                    </span>

                @elseif($riskLevel == 'Medium')
                    <span class="badge bg-warning text-dark">
                        {{ $riskLevel }}
                    </span>

                @elseif($riskLevel == 'High')
                    <span class="badge bg-danger">
                        {{ $riskLevel }}
                    </span>

                @else
                    <span class="badge bg-dark">
                        {{ $riskLevel }}
                    </span>
                @endif
            </p>

            <hr>

            <h4>Assigned Questions</h4>

            @if($assessment->questions->count())

                <ol>

                    @foreach($assessment->questions as $question)

                        <li class="mb-2">

                            {{ $question->question }}

                            <span class="badge bg-primary">
                                Weight: {{ $question->risk_weight }}
                            </span>

                        </li>

                    @endforeach

                </ol>

            @else

                <div class="alert alert-warning">
                    No questions assigned.
                </div>

            @endif

            <a href="/assessments" class="btn btn-secondary">
                Back
            </a>

        </div>

    </div>

</div>

</body>
</html>