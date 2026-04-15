<?php
namespace App\Exports;

use App\Models\Staff; // Ensure this matches your Model name
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StaffExport implements FromCollection, WithHeadings, WithMapping
{
    protected $role;

    public function __construct($role)
    {
        $this->role = $role;
    }

    public function collection()
    {
        // Filter by the 'role' enum column in your staff table
        return Staff::where('role', $this->role)->get();
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