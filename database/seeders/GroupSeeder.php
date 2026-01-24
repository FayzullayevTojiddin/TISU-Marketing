<?php

namespace Database\Seeders;

use App\Enums\GroupType;
use App\Models\Group;
use App\Models\Kurator;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    public function run(): void
    {
        $kurators = Kurator::all();

        if ($kurators->isEmpty()) {
            $this->command->warn('Kuratorlar topilmadi. Avval KuratorSeeder ishlating.');
            return;
        }

        $types = GroupType::cases();

        foreach ($kurators as $kurator) {

            $type = fake()->randomElement($types);

            for ($i = 1; $i <= 3; $i++) {

                Group::create([
                    'kurator_id' => $kurator->id,
                    'title' => "Guruh {$kurator->id}-{$i}",
                    'type' => $type,
                    'contract_price' => fake()->numberBetween(5_000_000, 15_000_000),
                ]);
            }
        }
    }
}
