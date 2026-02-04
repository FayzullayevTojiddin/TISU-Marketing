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
                    'sex' => fake()->randomElement(['male', 'female']),
                    'nationality' => fake()->randomElement(['Uzbek', 'Russian', 'Kazakh', 'Tajik']),
                    'birth_date' => fake()->date('Y-m-d', '2008-01-01'),

                    'from' => [
                        'region' => fake()->state(),
                        'city' => fake()->city(),
                    ],

                    'lives' => [
                        'region' => fake()->state(),
                        'address' => fake()->address(),
                    ],

                    'passport_address' => fake()->address(),
                    'image' => fake()->imageUrl(),
                    'file' => null,
                    'JSHSHR' => fake()->unique()->numerify('##############'),
                    'phone_number' => fake()->phoneNumber(),
                    'parents_number' => fake()->phoneNumber(),
                    'status' => fake()->boolean(90),
                ]);
            }
        }
    }
}
