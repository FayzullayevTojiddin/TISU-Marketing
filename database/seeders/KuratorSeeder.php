<?php

namespace Database\Seeders;

use App\Models\Kurator;
use App\Models\User;
use App\Models\Kafedra;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class KuratorSeeder extends Seeder
{
    public function run(): void
    {
        $kafedras = Kafedra::all();

        if ($kafedras->isEmpty()) {
            $this->command->warn('Kafedralar topilmadi. Avval KafedraSeeder ishlating.');
            return;
        }

        foreach ($kafedras as $kafedra) {

            for ($i = 1; $i <= 8; $i++) {

                $user = User::create([
                    'name' => "{$kafedra->title} Kurator {$i}",
                    'email' => "kurator_{$kafedra->id}_{$i}@example.com",
                    'password' => Hash::make('password'),
                    'role' => 'kurator',
                ]);

                Kurator::create([
                    'user_id' => $user->id,
                    'kafedra_id' => $kafedra->id,
                    'details' => [
                        'room' => 'C-' . rand(1, 20),
                        'phone' => '+99890' . rand(1000000, 9999999),
                    ],
                ]);
            }
        }
    }
}
