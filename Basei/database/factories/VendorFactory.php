<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VendorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->name,
            'item_cost'=>$this->faker->numberBetween(2000,20000),
            'item_quantity'=>$this->faker->numberBetween(1,500),
        ];
    }
}
