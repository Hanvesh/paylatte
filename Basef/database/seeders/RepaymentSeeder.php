<?php

namespace Database\Seeders;

use App\Models\Bill;
use App\Models\Repayment;
use App\Models\Transaction;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RepaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   $faker=Factory::create();
        $transaction = Transaction::all()->random();
        $transaction_date = $transaction->transaction_date;
        $bill = Bill::all()->random();
        $bill_id = $bill->id;
        $bill_amount=$bill->bill_amount;
        $bill_date=$bill->bill_due_date;
        DB::table('repayments')->insert([
            'bill_id'=>$bill_id,
            'repayment_amount'=>$bill_amount,
            'repayment_date'=>$faker->dateTimeBetween($bill_date,"$bill_date + 1 month"),
            'repayment_status'=>rand(0,1)
        ]);
    }
}
