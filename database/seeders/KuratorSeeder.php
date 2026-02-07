<?php

namespace Database\Seeders;

use App\Models\Kurator;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class KuratorSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 30; $i++) {
            $user = User::create([
                'name' => "Kurator {$i}",
                'email' => "kurator_{$i}@example.com",
                'password' => Hash::make('password'),
                'role' => 'kurator',
            ]);

            Kurator::create([
                'user_id' => $user->id,
                'details' => [
                    'room' => 'C-' . rand(1, 20),
                    'phone' => '+99890' . rand(1000000, 9999999),
                ],
            ]);
        }
    }
}
