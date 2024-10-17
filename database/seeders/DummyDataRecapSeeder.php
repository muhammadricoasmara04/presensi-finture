<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use \App\Models\Participan;

class DummyDataRecapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 30; $i++) {
            Participan::create([
                'name' => $faker->name,
                'status' => $faker->randomElement(['Hadir', 'Tidak Hadir', 'Izin']),
                'reason' => $faker->sentence,
                'checkin_time' => $faker->time('H:i'),
                'checkout_time' => $faker->time('H:i'),
                'date' => $faker->date(),
            ]);
        }
    }
}
