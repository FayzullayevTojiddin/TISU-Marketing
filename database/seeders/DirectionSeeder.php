<?php

namespace Database\Seeders;

use App\Models\Direction;
use App\Models\StudyForm;
use Illuminate\Database\Seeder;

class DirectionSeeder extends Seeder
{
    public function run(): void
    {
        $studyForms = StudyForm::all();

        if ($studyForms->isEmpty()) {
            $this->command->warn('❌ StudyForm topilmadi. Avval StudyFormSeeder ishlating.');
            return;
        }

        $usedCodes = [];

        foreach ($studyForms as $form) {
            $count = rand(5, 15);

            for ($i = 1; $i <= $count; $i++) {
                do {
                    $code = fake()->numerify('########');
                } while (in_array($code, $usedCodes));

                $usedCodes[] = $code;

                $form->directions()->create([
                    'title' => fake()->unique()->jobTitle(),
                    'code' => $code,
                    'contract_price' => fake()->numberBetween(6_000_000, 20_000_000),
                ]);
            }
        }

        $this->command->info('✅ Yo\'nalishlar yaratildi!');
    }
}
