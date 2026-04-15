<?php
namespace App\Exports;

use App\Models\Item;
use App\Models\Items;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ItemsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate = null, $endDate = null)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $query = Items::with('category');

        if ($this->startDate) {
            $query->whereDate('created_at', '>=', $this->startDate);
        }

        if ($this->endDate) {
            $query->whereDate('created_at', '<=', $this->endDate);
        }

        return $query->latest()->get();
    }

    // Define the column headers
    public function headings(): array
    {
        return [
            'ID',
            'Category',
            'Name',
            'Total',
            'Repair',
            'Lending',
        ];
    }

    // Map the data to the columns
    public function map($item): array
    {
        return [
            $item->id,
            $item->category->name ?? '—',
            $item->name,
            $item->total,
            $item->repair,
            $item->lending ?? 0,
        ];
    }
}