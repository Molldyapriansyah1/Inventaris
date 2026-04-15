@extends('layouts.dashboard')

@section('title', isset($item) ? 'Edit Item' : 'Add Item')
@section('subtitle', isset($item) ? 'Edit data <span>.items</span>' : 'Add new <span>.items</span>')

@section('content')

<div class="page-header d-flex align-items-center justify-content-between">
    <div>
        <h2>{{ isset($item) ? 'Edit Item' : 'Add Item' }}</h2>
        <p>{{ isset($item) ? 'Edit data' : 'Add new' }} <span>.items</span></p>
    </div>
    <a href="{{ route('items.index') }}" class="btn-edit">
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

    <form method="POST" action="{{ isset($item) ? route('items.update', $item->id) : route('items.store') }}">
        @csrf
        @if(isset($item))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label style="font-size:13px; font-weight:600; color:#555; margin-bottom:6px; display:block;">
                Name
            </label>
            <input type="text"
                   name="name"
                   value="{{ old('name', $item->name ?? '') }}"
                   placeholder="Item name"
                   style="width:100%; padding:9px 12px; font-size:14px; border:1px solid #e0e0e0; border-radius:8px; outline:none;"
                   required>
        </div>

        <div class="mb-3">
            <label style="font-size:13px; font-weight:600; color:#555; margin-bottom:6px; display:block;">
                Category
            </label>
            <select name="category_id"
                    style="width:100%; padding:9px 12px; font-size:14px; border:1px solid #e0e0e0; border-radius:8px; outline:none; background:#fff;"
                    required>
                <option value="">-- Pilih Category --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id', $item->category_id ?? '') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }} — {{ $category->division }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label style="font-size:13px; font-weight:600; color:#555; margin-bottom:6px; display:block;">
                Total
            </label>
            <input type="number"
                   name="total"
                   value="{{ old('total', $item->total ?? 0) }}"
                   min="0"
                   style="width:100%; padding:9px 12px; font-size:14px; border:1px solid #e0e0e0; border-radius:8px; outline:none;"
                   required>
        </div>

        <div class="mb-4">
            <label style="font-size:13px; font-weight:600; color:#555; margin-bottom:6px; display:block;">
                Repair
            </label>
            <input type="number"
                   name="repair"
                   value="{{ old('repair', $item->repair ?? 0) }}"
                   min="0"
                   style="width:100%; padding:9px 12px; font-size:14px; border:1px solid #e0e0e0; border-radius:8px; outline:none;"
                   required>
        </div>

        <button type="submit" class="btn-add" style="width:100%; justify-content:center;">
            <i class="bi bi-check-lg"></i>
            {{ isset($item) ? 'Update Item' : 'Save Item' }}
        </button>

    </form>
</div>

@endsection