<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'kader@app.com'],
            [
                'name' => 'Admin Kader',
                'password' => Hash::make('12345678'),
                'role' => 'kader'
            ]
        );

        $this->call([
            StandarWhoBBUSeeder::class,
            StandarWhoTBUSeeder::class,
        ]);

        User::updateOrCreate(
            ['email' => 'ortu@app.com'],
            [
                'name' => 'Orang Tua',
                'password' => Hash::make('12345678'),
                'role' => 'orang_tua'
            ]
        );
    }
}