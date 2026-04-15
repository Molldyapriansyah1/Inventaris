<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class lendingstaff extends Model
{
    protected $fillable = [
        'borrowerName',
        'item_id',
        'total',
        'keterangan',
        'borrowDate',
        'status',
        'edited_by',
    ];

    public function item()
    {
        return $this->belongsTo(Items::class);
    }
}
