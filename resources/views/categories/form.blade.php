@extends('layouts.dashboard')

@section('title', isset($category) ? 'Edit Category' : 'Add Category')
@section('subtitle', isset($category) ? 'Edit data .categories' : 'Add new .categories')

@section('content')

<div class="page-header d-flex align-items-center justify-content-between">
    <div>
        <h2>{{ isset($category) ? 'Edit Category' : 'Add Category' }}</h2>
        <p>{{ isset($category) ? 'Edit data' : 'Add new' }} <span>.categories</span></p>
    </div>
    <a href="{{ route('categories.index') }}" class="btn-edit">
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

    <form method="POST" action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}">
        @csrf
        @if(isset($category))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label style="font-size:13px; font-weight:600; color:#555; margin-bottom:6px; display:block;">
                Name
            </label>
            <input type="text"
                   name="name"
                   value="{{ old('name', $category->name ?? '') }}"
                   placeholder="Category name"
                   style="width:100%; padding:9px 12px; font-size:14px; border:1px solid #e0e0e0; border-radius:8px; outline:none;"
                   required>
        </div>

        <div class="mb-4">
            <label style="font-size:13px; font-weight:600; color:#555; margin-bottom:6px; display:block;">
                Division PJ
            </label>
            <select name="division"
                    style="width:100%; padding:9px 12px; font-size:14px; border:1px solid #e0e0e0; border-radius:8px; outline:none; background:#fff;">
                <option value="">-- Pilih Division --</option>
                <option value="Sarpras"  {{ old('division', $category->division ?? '') == 'Sarpras'  ? 'selected' : '' }}>Sarpras</option>
                <option value="Tefa"     {{ old('division', $category->division ?? '') == 'Tefa'     ? 'selected' : '' }}>Tefa</option>
                <option value="TU"       {{ old('division', $category->division ?? '') == 'TU'       ? 'selected' : '' }}>TU</option>
            </select>
        </div>

        <button type="submit" class="btn-add" style="width:100%; justify-content:center;">
            <i class="bi bi-check-lg"></i>
            {{ isset($category) ? 'Update Category' : 'Save Category' }}
        </button>

    </form>
</div>

@endsection