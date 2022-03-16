<?php

namespace Database\Seeders;

use App\Models\Refund;
use App\Models\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RefundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transaction = Transaction::all()->random();
        $trans_id = $transaction->id;
        $trans_amount=$transaction->transaction_amount;
        $transaction_date = $transaction->transaction_date;
        DB::table('refunds')->insert([
            'transaction_id'=> $trans_id,
            'refund_amount'=>$trans_amount,
            'refund_date'=>($transaction_date + 1)
        ]);
    }

}
