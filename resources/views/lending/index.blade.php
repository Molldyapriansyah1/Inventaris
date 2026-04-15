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
            <button type="button" class="btn-edit" style="background:#7c3aed; border:none;" data-bs-toggle="modal" data-bs-target="#exportModal">
                <i class="bi bi-file-earmark-excel me-1"></i> Export Excel
            </button>
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

{{-- Export Modal --}}
<div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.1);">
            <form action="{{ route('lendings.export') }}" method="GET">
                <div class="modal-header" style="border-bottom: 1px solid #f5f5f5; padding: 20px 24px;">
                    <h5 class="modal-title" id="exportModalLabel" style="font-weight: 700; color: #1a1a1a;">Export Lending Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 24px;">
                    <div class="mb-4">
                        <label class="form-label" style="font-weight: 600; color: #444; font-size: 14px; margin-bottom: 12px; display: block;">Select Export Range</label>
                        <div class="d-flex gap-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="export_type" id="exportAll" value="all" checked onchange="toggleDateInputs()">
                                <label class="form-check-label" for="exportAll" style="font-size: 14px; cursor: pointer;">All Lending Data</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="export_type" id="exportDateRange" value="date_range" onchange="toggleDateInputs()">
                                <label class="form-check-label" for="exportDateRange" style="font-size: 14px; cursor: pointer;">Specific Date Range</label>
                            </div>
                        </div>
                    </div>
                    
                    <div id="dateInputs" style="display: none; animation: fadeIn 0.3s ease;">
                        <div class="row">
                            <div class="col-md-6 mb-0">
                                <label for="start_date" class="form-label" style="font-weight: 500; color: #666; font-size: 13px;">Start Date</label>
                                <input type="date" class="form-control" name="start_date" id="start_date" style="border-radius: 8px; font-size: 14px; border: 1px solid #ddd;">
                            </div>
                            <div class="col-md-6 mb-0">
                                <label for="end_date" class="form-label" style="font-weight: 500; color: #666; font-size: 13px;">End Date</label>
                                <input type="date" class="form-control" name="end_date" id="end_date" style="border-radius: 8px; font-size: 14px; border: 1px solid #ddd;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 1px solid #f5f5f5; padding: 16px 24px;">
                    <button type="button" class="btn-del" data-bs-dismiss="modal" style="margin: 0;">Cancel</button>
                    <button type="submit" class="btn-edit" style="background:#7c3aed; border: none; margin: 0;">
                        <i class="bi bi-download me-1"></i> Download Excel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>

<script>
function toggleDateInputs() {
    const exportType = document.querySelector('input[name="export_type"]:checked').value;
    const dateInputs = document.getElementById('dateInputs');
    const startInput = document.getElementById('start_date');
    const endInput = document.getElementById('end_date');
    
    if (exportType === 'date_range') {
        dateInputs.style.display = 'block';
        startInput.setAttribute('required', 'required');
        endInput.setAttribute('required', 'required');
    } else {
        dateInputs.style.display = 'none';
        startInput.removeAttribute('required');
        endInput.removeAttribute('required');
        startInput.value = '';
        endInput.value = '';
    }
}
</script>

@endsection