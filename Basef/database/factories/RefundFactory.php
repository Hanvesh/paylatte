<?php

namespace Database\Factories;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RefundFactory extends Factory
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
            'transaction_id'=>Transaction::all()->pluck('id')->random(),
            'transaction_amount'=>$this->faker->numberBetween(2000,15000),
            'refund_date'=>$this->faker->dateTime
        ];
    }
}
