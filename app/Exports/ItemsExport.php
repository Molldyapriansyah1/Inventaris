<?php
namespace App\Exports;

use App\Models\Item;
use App\Models\Items;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ItemsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Fetch items with their category relationship
        return Items::with('category')->get();
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