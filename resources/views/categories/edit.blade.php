@extends('layouts.dashboard')

@section('title', isset($category) ? 'Edit Category' : 'Add Category')
@section('subtitle', isset($category) ? 'Edit data <span>.categories</span>' : 'Add new <span>.categories</span>')

@section('content')

<div class="page-header d-flex align-items-center justify-content-between">
    <div>
        <h2>{{ isset($category) ? 'Edit Category Forms' : 'Add Category Forms' }}</h2>
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

    <form method="POST" action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}">
        @csrf
        @if(isset($category)) @method('PUT') @endif

        {{-- Name --}}
        <div class="mb-4">
            <label style="font-size:14px; font-weight:600; color:#1a1a1a; display:block; margin-bottom:8px;">
                Name
            </label>
            <input type="text"
                   name="name"
                   value="{{ old('name', $category->name ?? '') }}"
                   placeholder="Nama kategori"
                   style="width:100%; padding:10px 14px; font-size:14px; border:1px solid #e0e0e0; border-radius:8px; outline:none; color:#333;"
                   required>
        </div>

        {{-- Division --}}
        <div class="mb-5">
            <label style="font-size:14px; font-weight:600; color:#1a1a1a; display:block; margin-bottom:8px;">
                Division PJ
            </label>
            <select name="division"
                    style="width:100%; padding:10px 14px; font-size:14px; border:1px solid #e0e0e0; border-radius:8px; outline:none; background:#fff; color:#333;"
                    required>
                <option value="">-- Pilih Division --</option>
                <option value="sarpras" {{ old('division', $category->division ?? '') == 'sarpras' ? 'selected' : '' }}>Sarpras</option>
                <option value="tefa"    {{ old('division', $category->division ?? '') == 'tefa'    ? 'selected' : '' }}>Tefa</option>
                <option value="tu"      {{ old('division', $category->division ?? '') == 'tu'      ? 'selected' : '' }}>TU</option>
            </select>
        </div>

        {{-- Actions --}}
        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('categories.index') }}"
               style="padding:10px 24px; font-size:14px; font-weight:500; background:#e0e0e0; color:#333; border-radius:8px; text-decoration:none; display:inline-flex; align-items:center;">
                Cancel
            </a>
            <button type="submit"
                    style="padding:10px 24px; font-size:14px; font-weight:600; background:#2b3ba0; color:#fff; border:none; border-radius:8px; cursor:pointer;">
                {{ isset($category) ? 'Update Category' : 'Save Category' }}
            </button>
        </div>

    </form>
</div>

@endsection