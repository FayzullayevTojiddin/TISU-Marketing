<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\StudentPayment;
use App\Enums\PaymentType;
use Illuminate\Database\Seeder;

class StudentPaymentSeeder extends Seeder
{
    public function run(): void
    {
        $students = Student::all();

        if ($students->isEmpty()) {
            $this->command->warn('Studentlar topilmadi. Avval StudentSeeder ishlating.');
            return;
        }

        foreach ($students as $student) {

            $count = fake()->numberBetween(3, 6);

            for ($i = 1; $i <= $count; $i++) {

                $type = fake()->randomElement(PaymentType::cases());

                StudentPayment::create([
                    'student_id' => $student->id,

                    'image' => fake()->boolean(70)
                        ? 'student-payments/sample-' . fake()->numberBetween(1, 5) . '.jpg'
                        : null,

                    'date' => fake()->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),

                    'amount' => $type === PaymentType::PLUS
                        ? fake()->numberBetween(500_000, 5_000_000)
                        : fake()->numberBetween(100_000, 1_500_000),

                    'type' => $type,

                    'description' => $type === PaymentType::PLUS
                        ? 'Kontrakt to‘lovi'
                        : 'Chegirma yoki qaytarim',
                ]);
            }
        }
    }
}
