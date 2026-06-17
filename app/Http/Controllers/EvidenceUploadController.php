<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\EvidenceUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class EvidenceUploadController extends Controller
{
    public function create(Assessment $assessment)
    {
        return view(
            'evidence_uploads.create',
            compact('assessment')
        );
    }

    public function store(
        Request $request,
        Assessment $assessment
    )
    {
        $request->validate([
            'document' => 'required|file'
        ]);

        $file = $request->file('document');

        $path = $file->store(
            'evidence',
            'public'
        );

        EvidenceUpload::create([
            'assessment_id' => $assessment->id,
            'file_name' => $file->getClientOriginalName(),
            'file_path' => $path
        ]);
          $questionCount = $assessment
    ->assessmentQuestions()
    ->count();

$evidenceCount = $assessment
    ->evidenceUploads()
    ->count();

if ($questionCount > 0 && $evidenceCount > 0) {

    $assessment->update([
        'status' => 'Completed'
    ]);

} else {

    $assessment->update([
        'status' => 'In Progress'
    ]);
}
       return redirect('/assessments/' . $assessment->id);
}

public function destroy(EvidenceUpload $evidence)
{
    $assessmentId = $evidence->assessment_id;

    Storage::disk('public')->delete(
        $evidence->file_path
    );

    $evidence->delete();

    $assessment = Assessment::find($assessmentId);

    $questionCount = $assessment
        ->assessmentQuestions()
        ->count();

    $evidenceCount = $assessment
        ->evidenceUploads()
        ->count();

    if ($questionCount > 0 && $evidenceCount > 0) {

        $assessment->update([
            'status' => 'Completed'
        ]);

    } else {

        $assessment->update([
            'status' => 'In Progress'
        ]);

    }

    return redirect(
        '/assessments/' . $assessmentId
    );
}
}