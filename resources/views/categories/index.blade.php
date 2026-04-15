@extends('layouts.dashboard')

@section('title', 'Categories')
@section('subtitle', 'Add, delete, update .categories')

@section('content')

<div class="page-header d-flex align-items-center justify-content-between">
    <div>
        <h2>Categories Table</h2>
        <p>Add, delete, update <span>.categories</span></p>
    </div>
    <a href="{{ route('categories.create') }}" class="btn-add">
        <i class="bi bi-plus-lg"></i> Add
    </a>
</div>


<div class="table-card">
    <table class="table mb-0">
        <thead>
            <tr>
                <th style="width:60px; text-align:center;">#</th>
                <th>Name</th>
                <th>Division PJ</th>
                <th>Total Items</th>
                <th style="text-align:right;">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
            <tr>
                <td style="text-align:center;">{{ $loop->iteration }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->division }}</td>
                <td>{{ $category->items_count ?? 0 }}</td>
                <td style="text-align:right;">
                    <a href="{{ route('categories.edit', $category->id) }}" class="btn-edit">Edit</a>
                    <form action="{{ route('categories.destroy', $category->id) }}"
                          method="POST" style="display:inline;"
                          onsubmit="return confirm('Hapus kategori ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-del">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align:center; color:#aaa; padding:32px;">
                    Belum ada kategori.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection