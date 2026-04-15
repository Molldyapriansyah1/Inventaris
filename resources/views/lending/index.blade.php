@extends('layouts.dashboard')

@section('title', 'Lending')
@section('subtitle', 'Data peminjaman barang')

@section('content')

<div class="page-header d-flex align-items-center justify-content-between">
    <div>
        <h2>Lending Table</h2>
        <p>Manage <span>.lendings</span></p>
    </div>
        <div class="d-flex gap-2">
            <a href="{{ route('lendings.export') }}" class="btn-edit" style="background:#7c3aed;">
                <i class="bi bi-file-earmark-excel me-1"></i> Export Excel
            </a>
            <a href="{{ route('lendings.create') }}" class="btn-add">
                <i class="bi bi-plus-lg"></i> Add
            </a>
        </div>
</div>

<div class="table-card">
    <table class="table mb-0">
        <thead>
            <tr>
                <th style="width:50px; text-align:center;">#</th>
                <th>Borrower</th>
                <th>Item</th>
                <th>Total</th>
                <th>Borrow Date</th>
                <th>Keterangan</th>
                <th>Status</th>
                <th>Edited By</th>
                <th style="text-align:right;">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($lendings as $lending)
            <tr>
                <td style="text-align:center;">{{ $loop->iteration }}</td>
                <td>{{ $lending->borrowerName }}</td>
                <td>{{ $lending->item->name ?? '—' }}</td>
                <td>{{ $lending->total }}</td>
                <td>{{ date('d M Y', strtotime($lending->borrowDate)) }}</td>
                <td>{{ $lending->keterangan ?? '—' }}</td>
                <td>{{ $lending->status }}</td>
                <td>{{ $lending->edited_by }}</td>
                <td style="text-align:right;">
                    @if($lending->status === 'borrowed')
                        <form action="{{ route('lendings.return', $lending->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                    style="background:#FEF3C7; color:#92400E; border:none; padding:6px 12px; border-radius:5px; font-size:12px; cursor:pointer; font-weight:500;">
                                return
                            </button>
                        </form>
                    @endif
                    <form action="{{ route('lendings.destroy', $lending->id) }}"
                          method="POST" style="display:inline;"
                         >
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-del">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" style="text-align:center; color:#aaa; padding:32px;">
                    Belum ada data peminjaman.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection