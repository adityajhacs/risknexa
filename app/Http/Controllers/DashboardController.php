<?php

namespace App\Http\Controllers;

use App\Models\Vendor;

class DashboardController extends Controller
{
    public function index()
    {
        $totalVendors = Vendor::count();
    $activeVendors = Vendor::where('status', 'Active')->count();
    $inactiveVendors = Vendor::where('status', 'Inactive')->count();
    $highRiskVendors = Vendor::where('criticality', 'High')->count();

    return view('dashboard.index', compact(
        'totalVendors',
        'activeVendors',
        'inactiveVendors',
        'highRiskVendors'
    ));
       
    }
}