<?php

namespace Database\Factories;

use App\Models\Bill;
use App\Models\Credit;
use App\Models\Refund;
use App\Models\Repayment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReportFactory extends Factory
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
            'credit_id'=>Credit::all()->pluck('id')->random(),
            'transaction_id'=>Refund::all()->pluck('transaction_id')->random(),
            'bill_id'=>Bill::all()->pluck('id')->random(),
            'repayment_id'=>Repayment::all()->pluck('id')->random(),
            'refund_id'=>Refund::all()->pluck('id')->random(),
        ];
    }
}
