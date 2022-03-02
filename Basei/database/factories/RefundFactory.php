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
    { $user = User::all()->random();
        $user_id = $user->id;
        $transaction = Transaction::all()->random();
        $trans_id = $transaction->id;
        $trans_amount=$transaction->transaction_amount;
        $transaction_status = $transaction->status;
        if($transaction_status == false){
            return [
            'user_id'=> $user_id,
            'transaction_id'=>$trans_id,
            'transaction_amount'=>$trans_amount,
            'refund_date'=>$this->faker->dateTime
        ];
    }
    }
}
