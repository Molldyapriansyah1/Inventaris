<?php
namespace App\Exports;

use App\Models\Staff; // Ensure this matches your Model name
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StaffExport implements FromCollection, WithHeadings, WithMapping
{
    protected $role;
    protected $startDate;
    protected $endDate;

    public function __construct($role, $startDate = null, $endDate = null)
    {
        $this->role = $role;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        $query = Staff::where('role', $this->role);

        if ($this->startDate) {
            $query->whereDate('created_at', '>=', $this->startDate);
        }

        if ($this->endDate) {
            $query->whereDate('created_at', '<=', $this->endDate);
        }

        return $query->latest()->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Password (Plain)', // Included since it's in your table
            'Role',
            'Created At'
        ];
    }

    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->email,
            $user->plain_password, 
            ucfirst($user->role),
            $user->created_at->format('Y-m-d H:i'),
        ];
    }
}