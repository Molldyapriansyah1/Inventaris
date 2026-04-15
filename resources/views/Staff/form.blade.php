@extends('layouts.dashboard')

@section('title', isset($staff) ? 'Edit Account' : 'Add Account')
@section('subtitle', isset($staff) ? 'Edit data <span>.accounts</span>' : 'Add new <span>.accounts</span>')

@section('content')

<div class="page-header d-flex align-items-center justify-content-between">
    <div>
        <h2>{{ isset($staff) ? 'Edit Account' : 'Add Account' }}</h2>
        <p>{{ isset($staff) ? 'Edit data' : 'Add new' }} <span>.accounts</span></p>
    </div>
    <a href="{{ route('staff.index') }}" class="btn-edit">
        <i class="bi bi-arrow-left me-1"></i> Back
    </a>
</div>

<div class="table-card p-4 mt-3" style="max-width: 560px;">

    @if($errors->any())
        <div class="alert-error-custom mb-3">
            <i class="bi bi-exclamation-circle me-1"></i>
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ isset($staff) ? route('staff.update', $staff->id) : route('staff.store') }}">
        @csrf
        @if(isset($staff))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label style="font-size:13px; font-weight:600; color:#555; margin-bottom:6px; display:block;">
                Name
            </label>
            <input type="text"
                   name="name"
                   value="{{ old('name', $staff->name ?? '') }}"
                   placeholder="Full name"
                   style="width:100%; padding:9px 12px; font-size:14px; border:1px solid #e0e0e0; border-radius:8px; outline:none;"
                   required>
        </div>

        <div class="mb-3">
            <label style="font-size:13px; font-weight:600; color:#555; margin-bottom:6px; display:block;">
                Email
            </label>
            <input type="email"
                   name="email"
                   value="{{ old('email', $staff->email ?? '') }}"
                   placeholder="email@example.com"
                   style="width:100%; padding:9px 12px; font-size:14px; border:1px solid #e0e0e0; border-radius:8px; outline:none;"
                   required>
        </div>

        

        <div class="mb-4">
            <label style="font-size:13px; font-weight:600; color:#555; margin-bottom:6px; display:block;">
                Role
            </label>
            <select name="role"
                    style="width:100%; padding:9px 12px; font-size:14px; border:1px solid #e0e0e0; border-radius:8px; outline:none; background:#fff;"
                    required>
                <option value="">-- Pilih Role --</option>
                <option value="admin"  {{ old('role', $staff->role ?? '') == 'admin'  ? 'selected' : '' }}>Admin</option>
                <option value="staff" {{ old('role', $staff->role ?? '') == 'staff' ? 'selected' : '' }}>Operator</option>
            </select>
        </div>

        <button type="submit" class="btn-add" style="width:100%; justify-content:center;">
            <i class="bi bi-check-lg"></i>
            {{ isset($staff) ? 'Update Account' : 'Save Account' }}
        </button>

    </form>
</div>

@endsection