<?php

namespace Database\Factories;

use App\Models\Division;
use Illuminate\Database\Eloquent\Factories\Factory;

class DivisionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Division::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->city(),
            'area' => $this->faker->numberBetween(0, 1000000),
            'type' => 'civil',
            'capital' => $this->faker->city(),
            'population' => $this->faker->numberBetween(0, 1000000),
            'is_city' => $this->faker->boolean(),
            'description' => $this->faker->text()
        ];
    }
}
