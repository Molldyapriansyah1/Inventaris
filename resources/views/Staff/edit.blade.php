@extends('layouts.dashboard')

@section('title', isset($staff) ? 'Edit Account' : 'Add Account')
@section('subtitle', isset($staff) ? 'Edit data accounts' : 'Add new <span>.accounts')

@section('content')

<div class="page-header d-flex align-items-center justify-content-between">
    <div>
        <h2>{{ isset($staff) ? 'Edit Account Forms' : 'Add Account Forms' }}</h2>
        <p>Please <span>.fill-all</span> input form with right value.</p>
    </div>
</div>

<div style="background:#fff; border-radius:12px; border:1px solid #ebebeb; padding:32px; max-width:600px; margin-top:16px;">

    @if($errors->any())
        <div class="alert-error-custom mb-3">
            <i class="bi bi-exclamation-circle me-1"></i>
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ isset($staff) ? route('staff.update', $staff->id) : route('staff.store') }}">
        @csrf
        @if(isset($staff)) @method('PUT') @endif

        {{-- Name --}}
        <div class="mb-4">
            <label style="font-size:14px; font-weight:600; color:#1a1a1a; display:block; margin-bottom:8px;">
                Name
            </label>
            <input type="text"
                   name="name"
                   value="{{ old('name', $staff->name ?? '') }}"
                   placeholder="Full name"
                   style="width:100%; padding:10px 14px; font-size:14px; border:1px solid #e0e0e0; border-radius:8px; outline:none; color:#333;"
                   required>
        </div>

        {{-- Email --}}
        <div class="mb-4">
            <label style="font-size:14px; font-weight:600; color:#1a1a1a; display:block; margin-bottom:8px;">
                Email
            </label>
            <input type="email"
                   name="email"
                   value="{{ old('email', $staff->email ?? '') }}"
                   placeholder="email@example.com"
                   style="width:100%; padding:10px 14px; font-size:14px; border:1px solid #e0e0e0; border-radius:8px; outline:none; color:#333;"
                   required>
        </div>

        {{-- New Password (edit only) --}}
        @if(isset($staff))
        <div class="mb-4">
            <label style="font-size:14px; font-weight:600; color:#1a1a1a; display:block; margin-bottom:8px;">
                New Password
                <span style="color:#f59e0b; font-weight:400; font-size:12px; margin-left:6px;">optional</span>
            </label>
            <input type="password"
                   name="new_password"
                   placeholder=""
                   style="width:100%; padding:10px 14px; font-size:14px; border:1px solid #e0e0e0; border-radius:8px; outline:none; color:#333;">
            @error('new_password')
                <div style="color:#991b1b; font-size:12px; margin-top:4px;">{{ $message }}</div>
            @enderror
        </div>
        @endif



        {{-- Role --}}
        @if(auth()->check() && auth()->user()->role === 'admin')
            <div class="mb-5">
                <label style="font-size:14px; font-weight:600; color:#1a1a1a; display:block; margin-bottom:8px;">
                    Role
                </label>
                <select name="role"
                        style="width:100%; padding:10px 14px; font-size:14px; border:1px solid #e0e0e0; border-radius:8px; outline:none; background:#fff; color:#333;"
                        required>
                    <option value="">-- Pilih Role --</option>
                    <option value="admin"  {{ old('role', $staff->role ?? '') == 'admin'  ? 'selected' : '' }}>Admin</option>
                    <option value="staff"  {{ old('role', $staff->role ?? '') == 'staff'  ? 'selected' : '' }}>Operator</option>
                </select>
            </div>
        @endif    
        {{-- Actions --}}
        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('staff.admin') }}"
               style="padding:10px 24px; font-size:14px; font-weight:500; background:#e0e0e0; color:#333; border-radius:8px; text-decoration:none; display:inline-flex; align-items:center;">
                Cancel
            </a>
            <button type="submit"
                    style="padding:10px 24px; font-size:14px; font-weight:600; background:#2b3ba0; color:#fff; border:none; border-radius:8px; cursor:pointer;">
                {{ isset($staff) ? 'Update Account' : 'Save Account' }}
            </button>
        </div>

    </form>
</div>

@endsection
