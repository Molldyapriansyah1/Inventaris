<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Staff extends Authenticatable
{
    protected $table = 'staff';

    protected $fillable = ['name', 'email', 'password', 'plain_password', 'role'];
    protected $hidden = ['password', 'plain_password'];
}