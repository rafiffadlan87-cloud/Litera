<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
User::updateOrCreate(
    ['email' => 'admin@litera.id'],
    [
        'name'     => 'Administrator',
        'password' => Hash::make('password'),
        'role'     => 'admin',
    ]
);

User::updateOrCreate(
    ['email' => 'petugas@litera.id'],
    [
        'name'     => 'Petugas Perpustakaan',
        'password' => Hash::make('password'),
        'role'     => 'petugas',
    ]
);

User::updateOrCreate(
    ['email' => 'rafif@gmail.com'],
    [
        'name'     => 'Rafif Fadlan',
        'password' => Hash::make('password'),
        'role'     => 'siswa',
    ]
);


        // 3. Settings
        DB::table('settings_system')->insert([
            ['key' => 'max_borrow_days', 'value' => '7', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'fine_per_day', 'value' => '1000', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'max_extension_days', 'value' => '3', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 4. Panggil BookSeeder
        $this->call(BookSeeder::class);
    }
}