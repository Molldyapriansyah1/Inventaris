<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('staff')->insert([
            [
                'name'           => 'Admin Wikrama',
                'email'          => 'admin@wikrama.sch.id',
                'password'       => Hash::make('admin123'),
                'plain_password' => 'admin123',
                'role'           => 'admin',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
           
        ]);
    }
}