<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Operator',
            'email' => 'admin@smkn2sumedang.sch.id',
            'password' => 'RahasiaNegara',
            'email_verified_at' => now()
        ]);
        User::factory()->create([
            'name' => 'Guru',
            'email' => 'guru@smkn2sumedang.sch.id',
            'password' => 'RahasiaNegara',
            'email_verified_at' => now()
        ]);
    }
}
