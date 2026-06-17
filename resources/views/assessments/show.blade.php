<!DOCTYPE html>
<html>
<head>
    <title>Assessment Details</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container-fluid px-5 mt-4">

    <div class="card shadow-lg border-0">

        <div class="card-header bg-dark text-white py-3">
            <h2 class="fw-bold">Assessment Details</h2>
        </div>

        <div class="card-body">
<table class="table table-bordered table-striped">

    <tr>
        <th width="30%">ID</th>
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
        <th>Due Date</th>
        <td>{{ $assessment->due_date }}</td>
    </tr>

    <tr>
        <th>Status</th>
        <td>
            <span class="badge bg-primary">
                {{ $assessment->status }}
            </span>
        </td>
    </tr>

</table>

            <hr>

            <hr>

<div class="row mb-4">

    <div class="col-md-3">
        <div class="card border-primary shadow-sm">
            <div class="card-body text-center">
                <h6 class="text-muted">Risk Score</h6>
                <h2 class="text-primary">
                    {{ $riskScore }}
                </h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-danger shadow-sm">
            <div class="card-body text-center">
                <h6 class="text-muted">Risk Level</h6>
                <h2 class="text-danger">
                    {{ $riskLevel }}
                </h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-success shadow-sm">
            <div class="card-body text-center">
                <h6 class="text-muted">Questions</h6>
                <h2 class="text-success">
                    {{ $assessment->assessmentQuestions->count() }}
                </h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-info shadow-sm">
            <div class="card-body text-center">
                <h6 class="text-muted">Evidence Files</h6>
                <h2 class="text-info">
                    {{ $assessment->evidenceUploads->count() }}
                </h2>
            </div>
        </div>
    </div>

</div>

            <hr>

            <h4 class="fw-bold text-primary mb-3">
    Assigned Questions
</h4>

            @if($assessment->assessmentQuestions->count())

    <table class="table table-bordered">

        <thead>

            <tr>
                <th>Question</th>
                <th>Response</th>
                <th>Score</th>
                <th>Reviewer Comment</th>
                <th>Action</th>
            </tr>

        </thead>

        <tbody>

       @foreach($assessment->assessmentQuestions as $item)

<tr>

    <td>
        {{ $item->question->question }}
    </td>

    <td>

        <form action="{{ route('assessment-questions.update', $item->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <select name="response"
                    class="form-select">

                <option value="">Select</option>

                <option value="Yes"
                    {{ $item->response == 'Yes' ? 'selected' : '' }}>
                    Yes
                </option>

                <option value="Partially"
                    {{ $item->response == 'Partially' ? 'selected' : '' }}>
                    Partially
                </option>

                <option value="No"
                    {{ $item->response == 'No' ? 'selected' : '' }}>
                    No
                </option>

            </select>

    </td>

    <td>
        {{ $item->score }}
    </td>
<td>

    <textarea
        name="reviewer_comment"
        class="form-control"
        rows="2">{{ $item->reviewer_comment }}</textarea>

</td>
    <td>

        <button type="submit"
                class="btn btn-primary btn-sm">
            Save
        </button>

        </form>

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
   class="btn btn-success btn-lg mb-3">
    Upload Evidence
</a>

<br><br>
<hr>

<h4 class="fw-bold text-success mb-3">
    Uploaded Evidence
</h4>

@if($assessment->evidenceUploads->count())

    <table class="table table-bordered">

       <thead>
<tr>
    <th>File Name</th>
    <th>Action</th>
    <th>Delete</th>
</tr>
</thead>

        <tbody>

        @foreach($assessment->evidenceUploads as $file)

            <tr>
                <td>
    {{ $file->file_name }}
</td>

<td>
    <a href="{{ asset('storage/' . $file->file_path) }}"
       target="_blank"
       class="btn btn-primary btn-sm">
        View
    </a>
</td>
<td>

    <form action="{{ route('evidence.destroy', $file->id) }}"
      method="POST">

        @csrf
        @method('DELETE')

        <button type="submit"
                class="btn btn-danger btn-sm">
            Delete
        </button>

    </form>

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
<a href="/assessments" class="btn btn-dark">
    Back
</a>

        </div>

    </div>

</div>

</body>
</html>