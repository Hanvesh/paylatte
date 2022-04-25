<?php

namespace Database\Factories;

use App\Models\Transaction;
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
        $transaction = Transaction::all()->random();
        $trans_id = $transaction->id;
        $trans_amount=$transaction->transaction_amount;
        $transaction_date = $transaction->transaction_date;
            return [
                'transaction_id'=> Transaction::all()->where('id',$trans_id)->first(),
            'bill_amount'=>$trans_amount,
            'bill_due_date'=>$this->faker->dateTimeBetween($transaction_date,"$transaction_date + 2 month"),
            'bill_status'=>$this->faker->boolean
        ];
    }


}
