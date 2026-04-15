@extends('layouts.dashboard')

@section('title', isset($item) ? 'Edit Item' : 'Add Item')
@section('subtitle', isset($item) ? 'Edit data <span>.items</span>' : 'Add new <span>.items</span>')

@section('content')

<div class="page-header d-flex align-items-center justify-content-between">
    <div>
        <h2>{{ isset($item) ? 'Edit Item Forms' : 'Add Item Forms' }}</h2>
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

    <form method="POST" action="{{ isset($item) ? route('items.update', $item->id) : route('items.store') }}">
        @csrf
        @if(isset($item)) @method('PUT') @endif

        {{-- Name --}}
        <div class="mb-4">
            <label style="font-size:14px; font-weight:600; color:#1a1a1a; display:block; margin-bottom:8px;">
                Item Name
            </label>
            <input type="text"
                   name="name"
                   value="{{ old('name', $item->name ?? '') }}"
                   placeholder="Nama barang"
                   style="width:100%; padding:10px 14px; font-size:14px; border:1px solid #e0e0e0; border-radius:8px; outline:none; color:#333;"
                   required>
        </div>

        {{-- Category --}}
        <div class="mb-4">
            <label style="font-size:14px; font-weight:600; color:#1a1a1a; display:block; margin-bottom:8px;">
                Category
            </label>
            <select name="category_id"
                    style="width:100%; padding:10px 14px; font-size:14px; border:1px solid #e0e0e0; border-radius:8px; outline:none; background:#fff; color:#333;"
                    required>
                <option value="">-- Pilih Category --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id', $item->category_id ?? '') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Total --}}
        <div class="mb-4">
            <label style="font-size:14px; font-weight:600; color:#1a1a1a; display:block; margin-bottom:8px;">
                Total
            </label>
            <input type="number"
                   name="total"
                   value="{{ old('total', $item->total ?? '') }}"
                   placeholder="Jumlah barang"
                   min="0"
                   style="width:100%; padding:10px 14px; font-size:14px; border:1px solid #e0e0e0; border-radius:8px; outline:none; color:#333;"
                   required>
        </div>

        {{-- Repair --}}
        <div class="mb-5">
            <label style="font-size:14px; font-weight:600; color:#1a1a1a; display:block; margin-bottom:8px;">
                Repair
                <span style="color:#aaa; font-weight:400; font-size:12px; margin-left:6px;">optional</span>
            </label>
            <input type="number"
                   name="repair"
                   value="{{ old('repair', $item->repair ?? 0) }}"
                   placeholder="Jumlah dalam perbaikan"
                   min="0"
                   style="width:100%; padding:10px 14px; font-size:14px; border:1px solid #e0e0e0; border-radius:8px; outline:none; color:#333;">
        </div>

        {{-- Actions --}}
        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('items.index') }}"
               style="padding:10px 24px; font-size:14px; font-weight:500; background:#e0e0e0; color:#333; border-radius:8px; text-decoration:none; display:inline-flex; align-items:center;">
                Cancel
            </a>
            <button type="submit"
                    style="padding:10px 24px; font-size:14px; font-weight:600; background:#2b3ba0; color:#fff; border:none; border-radius:8px; cursor:pointer;">
                {{ isset($item) ? 'Update Item' : 'Save Item' }}
            </button>
        </div>

    </form>
</div>

@endsection