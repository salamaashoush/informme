<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Division;
use App\Models\Governorate;
use Illuminate\Database\Seeder;

class GovernorateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Governorate::factory()
            ->count(8)
            ->has(Division::factory()
                ->count(4)
                ->has(City::factory()
                    ->state(function (array $attributes, Division $division) {
                        return ['gover_id' => $division->gover_id];
                    })
                    ->count(2)
                )
            )
            ->create();
    }
}
