<?php

namespace Database\Seeders;

use App\Models\Bill;
use App\Models\Transaction;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
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

        $user = \App\Models\User::all()->random();
        $user_id=$user->id;
        $transaction=Transaction::all()->where('sender_id',$user_id)->first();
        $trans_id=$transaction->id;
        $trans_amount = $transaction->transaction_amount;
        $trans_date= $transaction->transaction_date;
       $trans_amount= DB::table('transactions')
            ->groupBy('sender_id')->pluck('transaction_amount');
        DB::table('bills')->insert([
            'user_id'=>$user_id,
            'transaction_id'=>$trans_id,
            'bill_amount'=>$trans_amount,
            'bill_due_date'=>$faker->dateTimeBetween($trans_date,"$trans_date + 2 month"),
            'bill_status'=>rand(0,1)
        ]);


    }
}
