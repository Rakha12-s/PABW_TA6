<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PetugasSeeder extends Seeder
{
    public function run(): void
    {
        $faker = fake('id_ID');

        foreach (range(1, 5) as $index) {
            User::updateOrCreate(
                ['email' => 'petugas'.$index.'@laporbanjir.test'],
                [
                    'name' => $faker->name(),
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                ],
            );
        }

        User::updateOrCreate(
            ['email' => 'admin@bpbd-bandung.go.id'],
            [
                'name' => 'Admin BPBD Bandung',
                'password' => Hash::make('AdminBPBD2026'),
                'email_verified_at' => now(),
            ],
        );
    }
}
