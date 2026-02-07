<?php

namespace Database\Seeders;

use App\Models\EducationLevel;
use Illuminate\Database\Seeder;

class EducationLevelSeeder extends Seeder
{
    public function run(): void
    {
        $titles = [
            'Bakalavr',
            'Magistr',
            'Ordinatura',
            'Doktorantura',
            'Ikkinchi mutaxassislik',
        ];

        foreach ($titles as $title) {
            EducationLevel::create([
                'title' => $title,
                'status' => true,
            ]);
        }

        $this->command->info('✅ Ta\'lim darajalari yaratildi!');
    }
}
