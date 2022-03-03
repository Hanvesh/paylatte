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
    { $user = User::all()->random();
        $user_id = $user->id;
        $transaction = Transaction::all()->random();
        $trans_id = $transaction->id;
        $trans_amount=$transaction->transaction_amount;
        $transaction_status = $transaction->status;
        return [
            'user_id'=> User::all()->where('id',$user_id)->first(),
            'transaction_id'=> Transaction::all()->where('id',$trans_id)->first(),
            'bill_amount'=>$trans_amount,
            'bill_due_date'=>$this->faker->dateTime,
            'bill_status'=>$this->faker->boolean,
        ];}

}