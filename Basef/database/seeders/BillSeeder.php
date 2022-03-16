<?php

namespace Database\Seeders;

use App\Models\Bill;
use App\Models\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BillSeeder extends Seeder
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
        DB::table('bills')->insert([
            'transaction_id'=>$trans_id,
            'bill_amount'=>$trans_amount,
            'bill_due_date'=>$transaction_date + 2,
            'bill_status'=>rand(0,1)
        ]);
    }
}
