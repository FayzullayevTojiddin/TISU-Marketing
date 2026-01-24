<?php

namespace Database\Seeders;

use App\Models\Kafedra;
use App\Models\User;
use App\Models\Dekan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class KafedraSeeder extends Seeder
{
    public function run(): void
    {
        $dekans = Dekan::all();

        if ($dekans->isEmpty()) {
            $this->command->warn('Dekanlar topilmadi. Avval DekanSeeder ishlating.');
            return;
        }

        foreach ($dekans as $dekan) {

            for ($i = 1; $i <= 5; $i++) {

                $user = User::create([
                    'name' => "{$dekan->title} - Kafedra {$i}",
                    'email' => "kafedra_{$dekan->id}_{$i}@example.com",
                    'password' => Hash::make('password'),
                    'role' => 'kafedra',
                ]);

                Kafedra::create([
                    'user_id'  => $user->id,
                    'dekan_id' => $dekan->id,
                    'title' => "Kafedra {$dekan->id}-{$i}",
                    'details'  => [
                        'room' => 'B-' . rand(1, 20),
                        'phone' => '+998901234567',
                    ],
                ]);
            }
        }
    }
}
