<?php

namespace Database\Factories;

use App\Models\Credit;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Vendor;
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
        $user = User::all()->random();
        $user_id = $user->id;
        $pan = $user->pancard;
        $vendor = Vendor::all()->random();
        $vendor_id = $vendor->id;
        $credit = Credit::all()->random();
        $credit_id = $credit->id;
        $limit = $credit->credit_limit;

        $transaction = [
            'user_id' => $user_id,
            'credit_id' =>$credit_id,
            'vendor_id' => $vendor_id,
            'transaction_amount' =>$this->faker->numberBetween(0,$limit),
            'transaction_status' => $this->faker->boolean,
            'transaction_date' => $this->faker->dateTime,
        ];
       if($transaction['transaction_status']== true){ $transaction['credit_balance'] = $limit - $transaction['transaction_amount'];}
       else {$transaction['credit_balance'] = $limit;}
        return $transaction;


    }


}

