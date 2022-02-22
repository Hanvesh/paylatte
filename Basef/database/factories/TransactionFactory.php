<?php

namespace Database\Factories;

use App\Models\Credit;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'=> User::all()->pluck('id')->random(),
            'credit_id'=>Credit::all()->pluck('id')->random(),
            'transaction_amount'=>$this->faker->numberBetween(2000,15000),
            'transaction_status'=>$this->faker->boolean,
            'transaction_date'=>$this->faker->dateTime,
        ];
    }
}
