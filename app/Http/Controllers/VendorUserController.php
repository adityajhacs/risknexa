<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class VendorUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('vendor_id', auth()->user()->vendor_id)
            ->whereIn('role', ['vendor_admin', 'vendor'])
            ->get();

        return view('vendor-users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vendor-users.create');
    }

    /**
     * Store a newly created resource.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role' => 'required|in:vendor_admin,vendor',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'vendor_id' => auth()->user()->vendor_id,
        ]);

        return redirect()
            ->route('vendor-users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::where('vendor_id', auth()->user()->vendor_id)
            ->findOrFail($id);

        return view('vendor-users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::where('vendor_id', auth()->user()->vendor_id)
            ->findOrFail($id);

        return view('vendor-users.edit', compact('user'));
    }

    /**
     * Update the specified resource.
     */
    public function update(Request $request, $id)
    {
        $user = User::where('vendor_id', auth()->user()->vendor_id)
            ->findOrFail($id);

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:vendor_admin,vendor',
            'password' => 'nullable|min:8',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()
            ->route('vendor-users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource.
     */
    public function destroy($id)
    {
        $user = User::where('vendor_id', auth()->user()->vendor_id)
            ->findOrFail($id);

        // Khud ko delete na kar sake
        if ($user->id == auth()->id()) {
            return redirect()
                ->route('vendor-users.index')
                ->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()
            ->route('vendor-users.index')
            ->with('success', 'User deleted successfully.');
    }
}