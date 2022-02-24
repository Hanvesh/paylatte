<?php

namespace Database\Factories;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BillFactory extends Factory
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
            'transaction_id'=> Transaction::all()->pluck('id')->random(),
            'bill_amount'=>Transaction::all()->pluck('transaction_amount'),
            'bill_due_date'=>$this->faker->dateTime,
            'bill_status'=>$this->faker->boolean,
        ];
    }
}
