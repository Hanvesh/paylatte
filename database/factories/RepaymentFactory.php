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
        $transaction = Transaction::all()->random();
        $transaction_date = $transaction->transaction_date;
        $bill = Bill::all()->random();
        $bill_id = $bill->id;
        $bill_amount=$bill->bill_amount;
        $bill_date=$bill->bill_due_date;
        return [
            'bill_id'=>$bill_id,
            'repayment_amount'=> $bill_amount,
            'repayment_date'=> $this->faker->dateTimeBetween($transaction_date,"$transaction_date + 1 month"),
            'repayment_status'=>$this->faker->boolean()
        ];
    }
}
