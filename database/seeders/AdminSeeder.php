<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void // <--- AQUÍ ESTABA EL ERROR, DEBE SER RUN
    {
        Admin::create([
            'name' => 'Jeider Dev',
            'email' => 'adminPrueba@icala.com',
            'password' => Hash::make('prueba123#'),
            'email_verified_at' => now(),
        ]);
    }
}