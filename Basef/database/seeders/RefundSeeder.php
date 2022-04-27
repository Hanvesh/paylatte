<?php

namespace Database\Seeders;

use App\Models\Refund;
use App\Models\Transaction;
use Faker\Factory;
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
    {   $faker=Factory::create();
        $ids = Transaction::all()->random();
        $id = $ids->id;
        $transaction = Transaction::all()
        ->where('id','=',$id)
            ->where('transaction_status','=',false)->first();
        $trans_amount=$transaction->transaction_amount;
        $transaction_date = $transaction->transaction_date;
           DB::table('refunds')->insert([
               'transaction_id' => $id,
               'refund_amount' => $trans_amount,
               'refund_date' => now(),
               'refund_status'=>1,
           ]);
       }


}
