<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assessment;

class VendorPortalController extends Controller
{
    public function index()
    {
        $vendor = auth()->user()->vendor;

        $assessments = Assessment::where(
            'vendor_id',
            $vendor->id
        )->get();

        return view(
            'vendor.assessments',
            compact('assessments')
        );
    }
    public function show(Assessment $assessment)
{
    $vendor = auth()->user()->vendor;

    if ($assessment->vendor_id != $vendor->id) {
        abort(403);
    }

    $questions = $assessment->questions;

    return view(
        'vendor.assessment-details',
        compact('assessment', 'questions')
    );
}
}