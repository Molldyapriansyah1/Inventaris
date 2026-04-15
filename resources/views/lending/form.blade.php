@extends('layouts.dashboard')

@section('title', isset($lending) ? 'Edit Lending' : 'Add Lending')
@section('subtitle', isset($lending) ? 'Edit data <span>.lending</span>' : 'Add new <span>.lending</span>')

@section('content')

<div class="page-header d-flex align-items-center justify-content-between">
    <div>
        <h2>{{ isset($lending) ? 'Edit Lending Forms' : 'Add Lending Forms' }}</h2>
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

    <form method="POST" action="{{ isset($lending) ? route('lendings.update', $lending->id) : route('lendings.store') }}">
        @csrf
        @if(isset($lending)) @method('PUT') @endif

        {{-- Borrower Name --}}
        <div class="mb-4">
            <label style="font-size:14px; font-weight:600; color:#1a1a1a; display:block; margin-bottom:8px;">
                Borrower Name
            </label>
            <input type="text"
                   name="borrowerName"
                   value="{{ old('borrowerName', $lending->borrowerName ?? '') }}"
                   placeholder="Nama peminjam"
                   style="width:100%; padding:10px 14px; font-size:14px; border:1px solid #e0e0e0; border-radius:8px; outline:none;"
                   required>
        </div>

        {{-- Item --}}
        <div class="mb-4">
            <label style="font-size:14px; font-weight:600; color:#1a1a1a; display:block; margin-bottom:8px;">
                Item
            </label>
            <select name="item_id"
                    style="width:100%; padding:10px 14px; font-size:14px; border:1px solid #e0e0e0; border-radius:8px; outline:none; background:#fff;"
                    required>
                <option value="">-- Pilih Item --</option>
                @foreach($items as $item)
                    <option value="{{ $item->id }}"
                        {{ old('item_id', $lending->item_id ?? '') == $item->id ? 'selected' : '' }}>
                        {{ $item->name }}
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
                   value="{{ old('total', $lending->total ?? '') }}"
                   placeholder="Jumlah barang"
                   min="1"
                   style="width:100%; padding:10px 14px; font-size:14px; border:1px solid #e0e0e0; border-radius:8px; outline:none;"
                   required>
        </div>

        {{-- Keterangan --}}
        <div class="mb-4">
            <label style="font-size:14px; font-weight:600; color:#1a1a1a; display:block; margin-bottom:8px;">
                Keterangan
                <span style="color:#aaa; font-weight:400; font-size:12px; margin-left:6px;">optional</span>
            </label>
            <textarea name="keterangan"
                      placeholder="Catatan tambahan..."
                      style="width:100%; padding:10px 14px; font-size:14px; border:1px solid #e0e0e0; border-radius:8px; outline:none; resize:vertical;"
                      rows="3">{{ old('keterangan', $lending->keterangan ?? '') }}</textarea>
        </div>

       

        {{-- Actions --}}
        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('lendings.index') }}"
               style="padding:10px 24px; font-size:14px; font-weight:500; background:#e0e0e0; color:#333; border-radius:8px; text-decoration:none; display:inline-flex; align-items:center;">
                Cancel
            </a>
            <button type="submit"
                    style="padding:10px 24px; font-size:14px; font-weight:600; background:#2b3ba0; color:#fff; border:none; border-radius:8px; cursor:pointer;">
                {{ isset($lending) ? 'Update' : 'Save' }}
            </button>
        </div>

    </form>
</div>

@endsection