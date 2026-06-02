<!DOCTYPE html>
<html>
<head>
    <title>Assessment Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <div class="card shadow">
        <div class="card-header">
            <h3>Assessment Details</h3>
        </div>

        <div class="card-body">

            <p><strong>ID:</strong> {{ $assessment->id }}</p>

            <p><strong>Assessment Name:</strong>
                {{ $assessment->name }}
            </p>

            <p><strong>Risk Score:</strong>
                {{ $assessment->risk_score }}
            </p>

            <p><strong>Risk Level:</strong>
                {{ $assessment->risk_level }}
            </p>

            <a href="/assessments" class="btn btn-secondary">
                Back
            </a>

        </div>
    </div>

</div>

</body>
</html>