<?php

namespace Database\Factories;

use App\Models\ClassInfo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'class_info_id' => rand(1, 10),
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'age' => $this->faker->numberBetween(5, 25),
            'phone' => $this->faker->unique()->phoneNumber(),
            'address' => $this->faker->unique()->address(),
        ];
    }
}
