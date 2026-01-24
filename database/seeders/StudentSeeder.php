<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Group;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $groups = Group::all();

        if ($groups->isEmpty()) {
            $this->command->warn('Guruhlar topilmadi. Avval GroupSeeder ishlating.');
            return;
        }

        foreach ($groups as $group) {

            for ($i = 1; $i <= 30; $i++) {

                Student::create([
                    'group_id' => $group->id,
                    'full_name' => fake()->name(),
                    'JSHSHR' => fake()->unique()->numerify('##############'),
                    'status' => fake()->boolean(),
                ]);
            }
        }
    }
}
