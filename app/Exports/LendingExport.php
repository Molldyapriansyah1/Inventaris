<?php
namespace App\Exports;

use App\Models\LendingStaff;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LendingExport implements FromCollection, WithHeadings, WithMapping
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate = null, $endDate = null)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        $query = LendingStaff::with('item');

        if ($this->startDate) {
            $query->whereDate('borrowDate', '>=', $this->startDate);
        }

        if ($this->endDate) {
            $query->whereDate('borrowDate', '<=', $this->endDate);
        }

        return $query->latest()->get();
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