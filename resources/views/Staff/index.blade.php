@extends('layouts.dashboard')

@section('title', 'Admin Accounts')
@section('subtitle', 'Add, delete, update <span>.admin-accounts</span>')

@section('content')

<div class="page-header d-flex align-items-center justify-content-between">
    <div>
        <h2>Admin Accounts Table</h2>
        <p>Add, delete, update <span>.admin-accounts</span></p>
        <p style="font-size:12px; color:#e57373; margin-top:4px;">
            p.s password &nbsp; 4 character of email and nomor.
        </p>
    </div>
    <div class="d-flex gap-2">
        <button type="button" class="btn-edit" style="background:#7c3aed; border:none;" data-bs-toggle="modal" data-bs-target="#exportModal">
            <i class="bi bi-file-earmark-excel me-1"></i> Export Excel
        </button>
        <a href="{{ route('staff.create') }}" class="btn-add">
            <i class="bi bi-plus-lg"></i> Add
        </a>
    </div>
</div>

<div class="table-card">
    <table class="table mb-0">
        <thead>
            <tr>
                <th style="width:60px; text-align:center;">#</th>
                <th>Name</th>
                <th>Email</th>
                <th style="text-align:right;">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($admins as $admin)
            <tr>
                <td style="text-align:center;">{{ $loop->iteration }}</td>
                <td>{{ $admin->name }}</td>
                <td>{{ $admin->email }}</td>
                <td style="text-align:right;">
                    <a href="{{ route('staff.edit', $admin->id) }}" class="btn-edit">Edit</a>
                    {{-- <form action="{{ route('staff.destroy', $admin->id) }}"
                          method="POST" style="display:inline;"
                          onsubmit="return confirm('Hapus akun ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-del">Delete</button>
                    </form> --}}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align:center; color:#aaa; padding:32px;">
                    Belum ada admin.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

</div>

{{-- Export Modal --}}
<div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.1);">
            <form action="{{ route('staff.export') }}" method="GET">
                <input type="hidden" name="role" value="admin">
                <div class="modal-header" style="border-bottom: 1px solid #f5f5f5; padding: 20px 24px;">
                    <h5 class="modal-title" id="exportModalLabel" style="font-weight: 700; color: #1a1a1a;">Export Admin Accounts</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 24px;">
                    <div class="mb-4">
                        <label class="form-label" style="font-weight: 600; color: #444; font-size: 14px; margin-bottom: 12px; display: block;">Select Export Range</label>
                        <div class="d-flex gap-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="export_type" id="exportAll" value="all" checked onchange="toggleDateInputs()">
                                <label class="form-check-label" for="exportAll" style="font-size: 14px; cursor: pointer;">All Admin Accounts</label>
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
                        <p class="mt-2 mb-0" style="font-size: 12px; color: #888;">* Filters based on account creation date.</p>
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