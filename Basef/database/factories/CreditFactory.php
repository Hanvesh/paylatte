<?php

namespace Database\Factories;

use App\Models\User;
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
            'pancard'=>User::all()->pluck('pancard')->random(),
            'credit_score'=>$this->faker->numberBetween(300,900),
            'gross_revenue'=>$this->faker->numberBetween(10000,1000000),
            'liabilties'=>$this->faker->numberBetween(2000,50000),
            'credit_limit'=>$this->faker->numberBetween(2000,15000)
        ];
    }
}
