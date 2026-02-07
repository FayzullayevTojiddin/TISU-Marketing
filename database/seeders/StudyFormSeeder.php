<?php

namespace Database\Seeders;

use App\Models\StudyForm;
use App\Models\EducationLevel;
use Illuminate\Database\Seeder;

class StudyFormSeeder extends Seeder
{
    public function run(): void
    {
        $educationLevels = EducationLevel::all();

        if ($educationLevels->isEmpty()) {
            $this->command->warn('❌ EducationLevel topilmadi. Avval EducationLevelSeeder ishlating.');
            return;
        }

        $titles = [
            'Kunduzgi',
            'Sirtqi',
            'Kechki',
            'Masofaviy',
            'Ikkinchi mutaxassislik',
            'Dual',
            'Modul',
            'Onlayn',
            'Aralash',
            'Eksternat',
        ];

        foreach ($educationLevels as $level) {
            foreach ($titles as $title) {
                $level->studyForms()->create([
                    'title' => $title,
                    'status' => true,
                ]);
            }
        }

        $this->command->info('✅ Ta\'lim shakllari yaratildi!');
    }
}
