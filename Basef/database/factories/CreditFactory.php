<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CreditFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'pancard'=>$this->faker->unique()->regexify("/^([A-Z]){5}([0-9]){4}([A-Z]){1}?$/"),
            'credit_score'=>$this->faker->numberBetween(300,900),
            'gross_revenue'=>$this->faker->numberBetween(10000,1000000),
            'liabilties'=>$this->faker->numberBetween(2000,50000),
            'credit_limit'=>$this->faker->numberBetween(2000,15000)
        ];
    }
}
