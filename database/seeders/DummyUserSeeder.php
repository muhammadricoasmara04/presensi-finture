<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name' => 'Muhammad Ricoasmara',
                'email' => 'ricoasmara496@gmail.com',
                'bumn' => 'PT.Dahana',
                'role' => 'superadmin',
                'password' => bcrypt('04oktober2000')
            ],
            [
                'name' => 'johndoepeserta',
                'email' => 'johndoe@gmail.com',
                'bumn' => 'PT.Pupuk Indonesia',
                'role' => 'peserta',
                'password' => bcrypt('123456789')
            ],
            [
                'name' => 'johndoesss',
                'email' => 'johndoe1@gmail.com',
                'bumn' => 'PT.Pertamina',
                'role' => 'peserta',
                'password' => bcrypt('123456789')
            ]
        ];
        foreach ($userData as $key => $val) {
            User::create($val);
        }
    }
}
