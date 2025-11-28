<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'testuser@example.com', // ← GANTI INI SAJA
        ]);

        $this->call(CreatePelangganDummy::class);
    }
}
