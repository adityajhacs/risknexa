<!DOCTYPE html>
<html>
<head>
    <title>RiskNexa Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h1 class="mb-4">RiskNexa Dashboard</h1>

    <div class="row">

        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5>Total Vendors</h5>
                    <h2>{{ $totalVendors }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5>Active Vendors</h5>
                    <h2>{{ $activeVendors }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5>Inactive Vendors</h5>
                    <h2>{{ $inactiveVendors }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5>High Risk Vendors</h5>
                    <h2>{{ $highRiskVendors }}</h2>
                </div>
            </div>
        </div>

    </div>

    <br>

    <a href="/vendors" class="btn btn-primary">
        Manage Vendors
    </a>

</div>

</body>
</html>