<?php

namespace Database\Factories;

use App\Models\Credit;
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
        $transaction= [
            'user_id'=> User::all()->pluck('id')->random(),
            'credit_id'=>Credit::all()->pluck('id')->random(),
            'vendor_id'=>Vendor::all()->pluck('id')->random(),
            'credit_limit'=>Credit::all()->pluck('credit_limit'),
            'item_cost'=>Vendor::all()->pluck('item_cost'),
            'transaction_status'=>$this->faker->boolean,
            'transaction_date'=>$this->faker->dateTime,
        ];
        $transaction['transaction_amount']=$transaction['credit_limit']-$transaction['item_cost'];
        return $transaction;
    }
}
