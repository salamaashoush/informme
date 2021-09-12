<?php

namespace Database\Factories;

use App\Models\Governorate;
use Illuminate\Database\Eloquent\Factories\Factory;

class GovernorateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Governorate::class;

    /**
     * Define the model's default state.
     *
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->city(),
            'area' => $this->faker->numberBetween(0, 1000000),
            'type' => 'civil',
            'capital' => $this->faker->city(),
            'population' => $this->faker->numberBetween(0, 1000000),
            'code' => $this->faker->numberBetween(0, 100),
            'time_zone' => 'Egypt',
            'website' => $this->faker->url(),
            'description' => $this->faker->text()
        ];
    }
}
