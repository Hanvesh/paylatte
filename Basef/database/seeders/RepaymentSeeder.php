<?php

namespace Database\Seeders;

use App\Models\Bill;
use App\Models\Repayment;
use App\Models\Transaction;
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
    {
        $transaction = Transaction::all()->random();
        $transaction_date = $transaction->transaction_date;
        $bill = Bill::all()->random();
        $bill_id = $bill->id;
        $bill_amount=$bill->bill_amount;
        $bill_date=$bill->bill_due_date;
        DB::table('repayments')->insert([
            'bill_id'=>$bill_id,
            'repayment_amount'=>$bill_amount,
            'repayment_date'=>$bill_date,
            'repayment_status'=>rand(0,1)
        ]);
    }
}
