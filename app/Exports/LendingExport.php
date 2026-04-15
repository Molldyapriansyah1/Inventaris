<?php
namespace App\Exports;

use App\Models\LendingStaff;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LendingExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        // Load with the item relationship to avoid slow queries
        return LendingStaff::with('item')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Borrower Name',
            'Item Name',
            'Total',
            'Keterangan',
            'Borrow Date',
            'Status',
            'Edited By'
        ];
    }

    public function map($lending): array
    {
        return [
            $lending->id,
            $lending->borrowerName,
            $lending->item->name ?? 'N/A', // Get name from Item relationship
            $lending->total,
            $lending->keterangan,
            $lending->borrowDate,
            ucfirst($lending->status),
            $lending->edited_by,
        ];
    }
}