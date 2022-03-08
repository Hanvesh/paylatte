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
        $transaction = Transaction::all()->random();
        $trans_id = $transaction->id;
        $trans_amount=$transaction->transaction_amount;
        $transaction_status = $transaction->status;
        $transaction_date = $transaction->transaction_date;
        if($transaction_status == false){
            return [
            'transaction_id'=> Transaction::all()->where('id',$trans_id)->first(),
            'refund_amount'=>$trans_amount,
            'refund_date'=>$this->faker->dateTimeBetween($transaction_date,'+1 week')
        ];
    }
    }
}
