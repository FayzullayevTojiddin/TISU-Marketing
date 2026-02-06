<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Kafedra;
use App\Models\Kurator;
use App\Models\StudyForm;
use App\Models\EducationLevel;
use App\Models\Direction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GroupSeeder extends Seeder
{
    public function run(): void
    {
        $kurators = Kurator::all();
        $kafedras = Kafedra::all();

        if ($kurators->isEmpty()) {
            $this->command->warn('❌ Kuratorlar topilmadi. Avval KuratorSeeder ishlating.');
            return;
        }

        if ($kafedras->isEmpty()) {
            $this->command->warn('❌ Kafedralar topilmadi. Avval KafedraSeeder ishlating.');
            return;
        }

        $educationLevelTitles = [
            'Bakalavr',
            'Magistr',
            'Ordinatura',
            'Doktorantura',
            'Ikkinchi mutaxassislik',
        ];

        $educationLevels = collect();

        foreach ($educationLevelTitles as $title) {
            $educationLevels->push(
                EducationLevel::create([
                    'title' => $title,
                    'status' => true,
                ])
            );
        }

        $studyFormTitles = [
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

        $studyForms = collect();

        foreach ($studyFormTitles as $title) {
            $studyForms->push(
                StudyForm::create([
                    'education_level_id' => $educationLevels->random()->id,
                    'title' => $title,
                    'status' => true,
                ])
            );
        }

         $directions = collect();
        $usedCodes = [];

        foreach ($educationLevels as $level) {
            foreach ($studyForms as $form) {

                $count = rand(10, 20);

                for ($i = 1; $i <= $count; $i++) {

                    do {
                        $code = fake()->numerify('########');
                    } while (in_array($code, $usedCodes));

                    $usedCodes[] = $code;

                    $directions->push(
                        Direction::create([
                            'study_form_id' => $form->id,
                            'title' => fake()->unique()->jobTitle(),
                            'code' => $code,
                            'contract_price' => fake()->numberBetween(6_000_000, 20_000_000),
                        ])
                    );
                }
            }
        }

        for ($i = 1; $i <= 1000; $i++) {

            $direction = $directions->random();
            $year = fake()->numberBetween(2020, now()->year);

            $key = $direction->id . '-' . $year;


            if (! isset($titleCounters[$key])) {
                $titleCounters[$key] = 1;
            }

            $index = $titleCounters[$key]++;

            Group::create([
                'status' => fake()->boolean(95),
                'kurator_id' => $kurators->random()->id,
                'kafedra_id' => $kafedras->random()->id,
                'direction_id' => $direction->id,
                'enrollment_year' => $year,

                'title' => 'GROUP-' . Str::random(10),
            ]);
        }

        $this->command->info('✅ UniversitySeeder: hamma maʼlumotlar muvaffaqiyatli yaratildi!');
    }
}
