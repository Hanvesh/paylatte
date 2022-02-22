<?php

namespace Database\Factories;

use App\Models\Bill;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RepaymentFactory extends Factory
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
            'bill_id'=>Bill::all()->pluck('id')->random(),
            'repayment_amount'=>$this->faker->numberBetween(2000,15000),
            'repayment_date'=>$this->faker->dateTime,
            'repayment_status'=>$this->faker->boolean()
        ];
    }
}
