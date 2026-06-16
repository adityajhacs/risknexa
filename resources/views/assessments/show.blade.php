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

            @if($assessment->assessmentQuestions->count())

    <table class="table table-bordered">

        <thead>

            <tr>
                <th>Question</th>
                <th>Response</th>
                <th>Score</th>
            </tr>

        </thead>

        <tbody>

        @foreach($assessment->assessmentQuestions as $item)

            <tr>

                <td>
                    {{ $item->question->question }}
                </td>

                <td>

                    @if($item->response)

                        {{ $item->response }}

                    @else

                        <span class="badge bg-secondary">
                            Not Answered
                        </span>

                    @endif

                </td>

                <td>
                    {{ $item->score }}
                </td>

            </tr>

        @endforeach

        </tbody>

    </table>

@else

    <div class="alert alert-warning">
        No questions assigned.
    </div>

@endif
<a href="/assessments/{{ $assessment->id }}/evidence/create"
   class="btn btn-success mb-3">
    Upload Evidence
</a>

<br><br>
<hr>

<h4>Uploaded Evidence</h4>

@if($assessment->evidenceUploads->count())

    <table class="table table-bordered">

        <thead>
            <tr>
                <th>File Name</th>
            </tr>
        </thead>

        <tbody>

        @foreach($assessment->evidenceUploads as $file)

            <tr>
                <td>
                    {{ $file->file_name }}
                </td>
            </tr>

        @endforeach

        </tbody>

    </table>

@else

    <div class="alert alert-warning">
        No evidence uploaded.
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