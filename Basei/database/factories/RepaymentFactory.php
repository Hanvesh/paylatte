<?php

namespace Database\Factories;

use App\Models\Bill;
use App\Models\Transaction;
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
        $user = User::all()->random();
        $user_id = $user->id;
        $bill = Bill::all()->random();
        $bill_id = $bill->id;
        $bill_amount=$bill->bill_amount;
        return [
            'user_id'=> $user_id,
            'bill_id'=>$bill_id,
            'repayment_amount'=> $bill_amount,
            'repayment_date'=>$this->faker->dateTime,
            'repayment_status'=>$this->faker->boolean()
        ];
    }
}
