<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::factory()->create([
            'role' => 'super',
            'name' => 'Super Admin',
            'email' => 'super@tisu.uz',
            'password' => "As123456",
        ]);

        $this->call([
            DekanSeeder::class,
            KafedraSeeder::class,
            KuratorSeeder::class,
            GroupSeeder::class,
            StudentSeeder::class,
            // StudentPaymentSeeder::class,
        ]);
    }
}
