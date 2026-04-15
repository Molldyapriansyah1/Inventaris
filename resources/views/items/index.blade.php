@extends('layouts.dashboard')

@section('title', 'Items')
@section('subtitle', 'Add, delete, update.items')

@section('content')

<div class="page-header d-flex align-items-center justify-content-between">
    <div>
        <h2>Items Table</h2>
        <p>Add, delete, update <span>.items</span></p>
    </div>    
    
    @if(auth()->user()->role === 'admin')
    <div class="d-flex gap-2">
        <a href="{{ route('items.export') }}" class="btn-edit" style="background:#7c3aed;">
            <i class="bi bi-file-earmark-excel me-1"></i> Export Excel
        </a>
        
        <a href="{{ route('items.create') }}" class="btn-add">
            <i class="bi bi-plus-lg"></i> Add
        </a>
    </div>
    @endif
</div>

<div class="table-card">
    <table class="table mb-0">
        <thead>
            <tr>
                <th style="width:60px; text-align:center;">#</th>
                <th>Category</th>
                <th>Name</th>
                <th>Total</th>
                <th>Repair</th>
                <th>Lending</th>
                @if(auth()->check() && auth()->user()->role === 'admin')
                <th style="text-align:right;">Action</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse($items as $item)
            <tr>
                <td style="text-align:center;">{{ $loop->iteration }}</td>
                <td>{{ $item->category->name ?? '—' }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->total }}</td>
                <td>{{ $item->repair }}</td>
                <td>
                    @if(($item->lending ?? 0) > 0)
                         {{ $item->lending }}
                    @else
                        0
                    @endif
                </td>

                @if(auth()->check() && auth()->user()->role === 'admin')
                <td style="text-align:right;">
                    <a href="{{ route('items.edit', $item->id) }}" class="btn-edit">Edit</a>
                    <form action="{{ route('items.destroy', $item->id) }}"
                          method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-del">Delete</button>
                    </form>
                </td>
                @endif
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align:center; color:#aaa; padding:32px;">
                    Belum ada item.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection