<?php

namespace App\Http\Controllers;

use App\Models\lendingstaff;
use App\Models\Items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\LendingExport;
use Maatwebsite\Excel\Facades\Excel;



class LendingStaffController extends Controller
{
    public function index()
        {
            $lendings = lendingstaff::with('item')->latest()->get();
            return view('lending.index', compact('lendings'));
        }

        public function create()
        {
            $items = Items::all();
            return view('lending.form', compact('items'));
        }

    public function store(Request $request)
    {
        $request->validate([
            'borrowerName' => 'required|string|max:255',
            'item_id'      => 'required|exists:items,id',
            'total'        => 'required|integer|min:1',
            'keterangan'   => 'nullable|string',
            'edited_by'    => 'required|string|max:255',
        ]);

        /** @var \App\Models\Staff $user */
        $user = Auth::user();

        $item = Items::findOrFail($request->item_id);

        // Cek stok cukup
        if ($request->total > $item->total) {
            return back()->withErrors([
                'total' => 'Stok tidak cukup. Tersedia: ' . $item->total
            ])->withInput();
        }

        // Kurangi total, tambah lending di tabel items
        $item->decrement('total', $request->total);
        $item->increment('lending', $request->total);

        lendingstaff::create([
            'borrowerName' => $request->borrowerName,
            'item_id'      => $request->item_id,
            'total'        => $request->total,
            'keterangan'   => $request->keterangan,
            'borrowDate'   => date('Y-m-d'),
            'status'       => 'borrowed',
            'edited_by'    => $request->edited_by,
        ]);

        return redirect()->route('lendings.index')
                        ->with('success', 'Data peminjaman berhasil ditambahkan.');
    }

    public function edit(lendingstaff $lending)
    {
        $items = Items::all();
        return view('lending.form', compact('lending', 'items'));
    }

    public function update(Request $request, lendingstaff $lending)
    {
        $request->validate([
            'borrowerName' => 'required|string|max:255',
            'item_id'      => 'required|exists:items,id',
            'total'        => 'required|integer|min:1',
            'keterangan'   => 'nullable|string',
            'edited_by'    => 'required|string|max:255',
        ]);

        /** @var \App\Models\Staff $user */
        $user = Auth::user();

        $lending->update([
            'borrowerName' => $request->borrowerName,
            'item_id'      => $request->item_id,
            'total'        => $request->total,
            'keterangan'   => $request->keterangan,
            'borrowDate'   => date('Y-m-d'),
            'status'       => $lending->status, 
            'edited_by'    => $request->edited_by,
        ]);

        return redirect()->route('lendings.index')
                        ->with('success', 'Data peminjaman berhasil diperbarui.');
    }

    public function destroy(lendingstaff $lending)
    {
        $lending->delete();
        return redirect()->route('lendings.index')
                         ->with('success', 'Data peminjaman berhasil dihapus.');
    }
    public function updateStatus(lendingstaff $lending)
    {
        /** @var \App\Models\Staff $user */
        $user = Auth::user();

        $item = Items::findOrFail($lending->item_id);

        // Kembalikan total, kurangi lending di tabel items
        $item->increment('total', $lending->total);
        $item->decrement('lending', $lending->total);

        $lending->update([
            'status'    => 'returned',
            'edited_by' => $user->name,
        ]);

        return redirect()->route('lendings.index')
                        ->with('success', 'Status berhasil diperbarui.');
    }
    public function export(Request $request) 
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        return Excel::download(new LendingExport($startDate, $endDate), 'lending_report.xlsx');
    }
}