<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\User;
use App\Models\Vendor;

class VendorDashboardController extends Controller
{
    public function index()
    {
        $vendorId = auth()->user()->vendor_id;
        $vendor = auth()->user()->vendor;

        // Team Members
        $teamCount = User::where('vendor_id', $vendorId)->count();

        // Total Assessments
        $assessmentCount = Assessment::where('vendor_id', $vendorId)->count();

        // Completed
        $completed = Assessment::where('vendor_id', $vendorId)
            ->where('status', 'Completed')
            ->count();

        // Pending
        $pending = Assessment::where('vendor_id', $vendorId)
            ->where('status', 'Pending')
            ->count();

        // Recent Assessments
        $recentAssessments = Assessment::where('vendor_id', $vendorId)
            ->latest()
            ->take(5)
            ->get();

        // Recent Team Members
        $teamMembers = User::where('vendor_id', $vendorId)
            ->latest()
            ->take(5)
            ->get();

        return view('vendor.dashboard', compact(
            'vendor',
            'assessmentCount',
            'pending',
            'completed',
            'teamCount',
            'recentAssessments',
            'teamMembers'
        ));
    }
}