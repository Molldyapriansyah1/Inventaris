@extends('layouts.dashboard')

@section('title', 'Operator Accounts')
@section('subtitle', 'Add, delete, update <span>.operator-accounts</span>')

@section('content')

<div class="page-header d-flex align-items-center justify-content-between">
    <div>
        <h2>Operator Accounts Table</h2>
        <p>Add, delete, update <span>.operator-accounts</span></p>
        <p style="font-size:12px; color:#e57373; margin-top:4px;">
            p.s password &nbsp; 4 character of email and nomor.
        </p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('staff.export',['role' => 'staff']) }}" class="btn-edit" style="background:#7c3aed;">
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
            @forelse($operators as $operator)
            <tr>
                <td style="text-align:center;">{{ $loop->iteration }}</td>
                <td>{{ $operator->name }}</td>
                <td>{{ $operator->email }}</td>
                <td style="text-align:right;">
                    <a href="{{ route('staff.edit', $operator->id) }}" class="btn-edit">Edit</a>
                    <form action="{{ route('staff.destroy', $operator->id) }}"
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
                    Belum ada operator.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection