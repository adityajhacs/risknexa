<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\Assessment;

class DashboardController extends Controller
{
    public function index()
    {
        $totalVendors = Vendor::count();

        $activeVendors = Vendor::where(
            'status',
            'Active'
        )->count();

        $inactiveVendors = Vendor::where(
            'status',
            'Inactive'
        )->count();

        $highRiskVendors = Vendor::where(
            'criticality',
            'High'
        )->count();

        $totalAssessments = Assessment::count();

        $pendingAssessments = Assessment::where(
            'status',
            'Pending'
        )->count();

        $completedAssessments = Assessment::where(
            'status',
            'Completed'
        )->count();
        $lowRiskAssessments = Assessment::where(
    'risk_level',
    'Low'
)->count();

$mediumRiskAssessments = Assessment::where(
    'risk_level',
    'Medium'
)->count();

$highRiskAssessments = Assessment::where(
    'risk_level',
    'High'
)->count();

$criticalRiskAssessments = Assessment::where(
    'risk_level',
    'Critical'
)->count();
        $recentAssessments = Assessment::latest()
    ->take(5)
    ->get();

        return view('dashboard.index', compact(
            'totalVendors',
            'activeVendors',
            'inactiveVendors',
            'highRiskVendors',
            'totalAssessments',
            'pendingAssessments',
            'completedAssessments',
            'recentAssessments',
            'lowRiskAssessments',
'mediumRiskAssessments',
'highRiskAssessments',
'criticalRiskAssessments'
        ));
    }

    public function calculateRiskLevel($score)
    {
        if ($score <= 25) {
            return 'Low';
        }

        if ($score <= 50) {
            return 'Medium';
        }

        if ($score <= 75) {
            return 'High';
        }

        return 'Critical';
    }
}