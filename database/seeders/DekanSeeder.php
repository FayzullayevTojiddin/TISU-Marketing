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
        $dekanlar = [
            ['name' => 'Abdunazarov O\'ktam Qushoqovich', 'fakultet' => 'Magistratura'],
            ['name' => 'Bazarov Sobirjon Bektoshevich', 'fakultet' => 'Pedagogika va ijtimoiy-gumanitar fanlar'],
            ['name' => 'Babamurotov Bekzod Ergashevich', 'fakultet' => 'Tibbiyot'],
            ['name' => 'Yarmatov Sharofiddin Choriyevich', 'fakultet' => 'Iqtisodiyot va axborot texnologiyalari'],
        ];

        foreach ($dekanlar as $index => $item) {
            $i = $index + 1;

            $user = User::create([
                'name' => $item['name'],
                'email' => "dekan{$i}@tisu.uz",
                'password' => Hash::make('password'),
                'role' => 'dekan',
            ]);

            Dekan::create([
                'user_id' => $user->id,
                'title' => $item['fakultet'],
                'details' => [
                    'phone' => '+9989000000' . $i,
                    'room' => 'A-' . $i,
                ],
            ]);
        }

        $this->command->info('✅ 4 ta dekan yaratildi!');
    }
}
