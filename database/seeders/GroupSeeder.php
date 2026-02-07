<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Kafedra;
use App\Models\Kurator;
use App\Models\Direction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GroupSeeder extends Seeder
{
    public function run(): void
    {
        $kurators = Kurator::all();
        $kafedras = Kafedra::all();
        $directions = Direction::with('studyForm')->get();

        if ($kurators->isEmpty() || $kafedras->isEmpty() || $directions->isEmpty()) {
            $this->command->warn('❌ Avval KuratorSeeder, KafedraSeeder va DirectionSeeder ishlating.');
            return;
        }

        $titleCounters = [];

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
                'kafedra_id' => $kafedras->random()->id,
                'kurator_id' => $kurators->random()->id,
                'direction_id' => $direction->id,
                'enrollment_year' => $year,
                'title' => 'GROUP-' . Str::random(10),
            ]);
        }

        $this->command->info('✅ 1000 ta guruh yaratildi!');
    }
}
