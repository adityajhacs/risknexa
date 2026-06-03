<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class vendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendors = Vendor::all();

return view('vendors.index', compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vendors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
    'vendor_name' => 'required',
<<<<<<< HEAD
  'email' => 'required|email|unique:vendors,email',
=======
    'email' => 'required|email',
>>>>>>> origin/feature/compliance-question-bank
    'contact_person' => 'required',
    'phone' => 'required',
'country' => 'required'
]);
     Vendor::create([
    'vendor_name' => $request->vendor_name,
    'contact_person' => $request->contact_person,
    'email' => $request->email,
    'phone' => $request->phone,
    'country' => $request->country,
    'criticality' => $request->criticality,
    'status' => $request->status,
]);


    return redirect('/vendors');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vendor $vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vendor $vendor)
    {
        return view('vendors.edit', compact('vendor'));

   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vendor $vendor)
    {
        $request->validate([
    'vendor_name' => 'required',
    'email' => 'required|email',
    'contact_person' => 'required',
    'phone' => 'required',
'country' => 'required'
]);
        $vendor->update([
        'vendor_name' => $request->vendor_name,
        'contact_person' => $request->contact_person,
        'email' => $request->email,
        'phone' => $request->phone,
        'country' => $request->country,
    ]);

    return redirect('/vendors');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vendor $vendor)
    {
        $vendor->delete();

    return redirect('/vendors');
    }
}
