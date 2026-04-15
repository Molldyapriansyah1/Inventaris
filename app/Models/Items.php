<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Categories;

class Items extends Model
{
    protected $fillable = ['name', 'category_id', 'total', 'repair'];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
}
