<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Exports\StaffExport;
use Maatwebsite\Excel\Facades\Excel;

class StaffController extends Controller
{
    public function index()
    {
        $admins    = Staff::where('role', 'admin')->get();
        $operators = Staff::where('role', 'staff')->get();
        return view('Staff.index', compact('admins', 'operators'));
    }

    public function create()
    {
        return view('Staff.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:staff,email',
            'role'  => 'required|in:admin,staff',
        ]);

        // Simpan dulu untuk dapat ID
        $staff = Staff::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make('temporary'),
            'role'     => $request->role,
        ]);

        // Generate password: 4 huruf email + id
        $password = substr($request->email, 0, 4) . $staff->id;

        // Update dengan password yang benar
        $staff->update([
            'plain_password' => $password,
            'password'       => Hash::make($password),
        ]);

        return redirect()->route('staff.admin')
                        ->with('success', 'Akun berhasil dibuat. Password: ' . $password);
    }

    public function edit(Staff $staff)
    {
        return view('Staff.edit', compact('staff'));
    }


    public function update(Request $request, Staff $staff)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|unique:staff,email,' . $staff->id,
            'role'         => 'nullable|in:admin,staff',
            'new_password' => 'nullable|string', 
        ]);

        $data = [
    'name'  => $request->name,
    'email' => $request->email,
];

    // Hanya update role kalau field role ada di request (admin)
    if ($request->filled('role')) {
        $data['role'] = $request->role;
    }

    // Hanya update password kalau diisi
    if ($request->filled('new_password')) {
        $data['plain_password'] = $request->new_password;
        $data['password']       = Hash::make($request->new_password);
    }

    $staff->update($data);

    return redirect()->route('staff.admin')
                    ->with('success', 'Akun berhasil diperbarui.');
    }

    public function destroy(Staff $staff)
    {
        $staff->delete();
        return redirect()->route('staff.index')
                         ->with('success', 'Akun berhasil dihapus.');
    }
    public function adminIndex()
    {
        $admins = Staff::where('role', 'admin')->get();
        return view('Staff.index', compact('admins'));
    }

    public function operatorIndex()
    {
        $operators = Staff::where('role', 'staff')->get();
        return view('Staff.index2', compact('operators'));
    }
    public function export(Request $request) 
    {
        // Get role from URL (e.g., ?role=admin), default to 'staff'
        $role = $request->query('role', 'staff'); 
        
        $fileName = $role . '_accounts_' . now()->format('Y-m-d') . '.xlsx';

        return Excel::download(new StaffExport($role), $fileName);
    }
}