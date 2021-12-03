<?php

namespace Database\Factories;

use App\Models\Scholar;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScholarFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Scholar::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'total_Slp' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 100.00, $max = 1000),
        ];
    }
}
