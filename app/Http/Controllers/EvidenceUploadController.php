<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\EvidenceUpload;
use Illuminate\Http\Request;

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

        return redirect('/assessments/' . $assessment->id);
    }
}