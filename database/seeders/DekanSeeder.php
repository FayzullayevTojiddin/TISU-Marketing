<?php

namespace Database\Seeders;

use App\Models\Dekan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DekanSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 4; $i++) {

            $user = User::create([
                'name' => "Dekan {$i}",
                'email' => "dekan{$i}@example.com",
                'password' => Hash::make('password'),
                'role' => 'dekan',
            ]);

            Dekan::create([
                'user_id' => $user->id,
                'title' => "Fakultet dekani #{$i}",
                'details' => [
                    'phone' => '+9989000000' . $i,
                    'room'  => 'A-' . $i,
                ],
            ]);
        }
    }
}
