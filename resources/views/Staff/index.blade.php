@extends('layouts.dashboard')

@section('title', 'Admin Accounts')
@section('subtitle', 'Add, delete, update <span>.admin-accounts</span>')

@section('content')

<div class="page-header d-flex align-items-center justify-content-between">
    <div>
        <h2>Admin Accounts Table</h2>
        <p>Add, delete, update <span>.admin-accounts</span></p>
        <p style="font-size:12px; color:#e57373; margin-top:4px;">
            p.s password &nbsp; 4 character of email and nomor.
        </p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('staff.export',['role' => 'admin']) }}" class="btn-edit" style="background:#7c3aed;">
            <i class="bi bi-file-earmark-excel me-1"></i> Export Excel
        </a>
        <a href="{{ route('staff.create') }}" class="btn-add">
            <i class="bi bi-plus-lg"></i> Add
        </a>
    </div>
</div>

<div class="table-card">
    <table class="table mb-0">
        <thead>
            <tr>
                <th style="width:60px; text-align:center;">#</th>
                <th>Name</th>
                <th>Email</th>
                <th style="text-align:right;">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($admins as $admin)
            <tr>
                <td style="text-align:center;">{{ $loop->iteration }}</td>
                <td>{{ $admin->name }}</td>
                <td>{{ $admin->email }}</td>
                <td style="text-align:right;">
                    <a href="{{ route('staff.edit', $admin->id) }}" class="btn-edit">Edit</a>
                    <form action="{{ route('staff.destroy', $admin->id) }}"
                          method="POST" style="display:inline;"
                          onsubmit="return confirm('Hapus akun ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-del">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align:center; color:#aaa; padding:32px;">
                    Belum ada admin.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection