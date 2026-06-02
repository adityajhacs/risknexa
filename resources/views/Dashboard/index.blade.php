<!DOCTYPE html>
<html>
<head>
    <title>RiskNexa Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h1 class="mb-4 text-center">RiskNexa Dashboard</h1>

    <div class="row g-4">

        <div class="col-md-3">
            <div class="card bg-primary text-white shadow">
                <div class="card-body text-center">
                    <h5>Total Vendors</h5>
                    <h2>{{ $totalVendors }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-success text-white shadow">
                <div class="card-body text-center">
                    <h5>Active Vendors</h5>
                    <h2>{{ $activeVendors }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-secondary text-white shadow">
                <div class="card-body text-center">
                    <h5>Inactive Vendors</h5>
                    <h2>{{ $inactiveVendors }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-danger text-white shadow">
                <div class="card-body text-center">
                    <h5>High Risk Vendors</h5>
                    <h2>{{ $highRiskVendors }}</h2>
                </div>
            </div>
        </div>

    </div>

    <div class="row g-4 mt-3">

        <div class="col-md-4">
            <div class="card bg-info text-white shadow">
                <div class="card-body text-center">
                    <h5>Total Assessments</h5>
                    <h2>{{ $totalAssessments }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-warning text-dark shadow">
                <div class="card-body text-center">
                    <h5>Pending Assessments</h5>
                    <h2>{{ $pendingAssessments }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-success text-white shadow">
                <div class="card-body text-center">
                    <h5>Completed Assessments</h5>
                    <h2>{{ $completedAssessments }}</h2>
                </div>
            </div>
        </div>

    </div>

    <div class="mt-5">
        <a href="/vendors" class="btn btn-primary me-2">
            Manage Vendors
        </a>

        <a href="/assessments" class="btn btn-success">
            Manage Assessments
        </a>
    </div>

    <!-- Recent Assessments -->

    <div class="mt-5">
        <h3>Recent Assessments</h3>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Assessment Name</th>
                    <th>Status</th>
                    <th>Due Date</th>
                </tr>
            </thead>

            <tbody>
                @foreach($recentAssessments as $assessment)
                <tr>
                    <td>{{ $assessment->id }}</td>
                    <td>{{ $assessment->assessment_name }}</td>

                    <td>
                        @if($assessment->status == 'Pending')
                            <span class="badge bg-warning text-dark">
                                Pending
                            </span>
                        @elseif($assessment->status == 'Completed')
                            <span class="badge bg-success">
                                Completed
                            </span>
                        @else
                            <span class="badge bg-info">
                                {{ $assessment->status }}
                            </span>
                        @endif
                    </td>

                    <td>{{ $assessment->due_date }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Chart -->

    <div class="mt-5">
        <h3 class="text-center mb-4">
            Assessment Status Chart
        </h3>

        <canvas id="assessmentChart"></canvas>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('assessmentChart');

new Chart(ctx, {
    type: 'bar',

    data: {
        labels: ['Pending', 'Completed'],
        datasets: [{
            label: 'Assessments',
            data: [
                {{ $pendingAssessments }},
                {{ $completedAssessments }}
            ],
            backgroundColor: [
                '#ffc107',
                '#198754'
            ],
            borderWidth: 1
        }]
    },

    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>

</body>
</html>