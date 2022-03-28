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
        $faker = Factory::create();
        $user = \App\Models\User::all()->random();
        $user_id=$user->id;
        $transaction = DB::table('transactions')->select('receiver_id', 'transaction_amount',
            'transaction_date', 'transaction_status')->where('sender_id', '=', $user_id)
            ->where('transaction_status','=',true)->get();
        $bill = $transaction->sum('transaction_amount');
        $trans_date = $transaction->get('transaction_date');
        DB::table('bills')->insert([
            'user_id'=>$user_id,
            'bill_amount'=>$bill,
            'bill_due_date'=>$faker->dateTimeBetween($trans_date,"$trans_date + 2 month"),
            'bill_status'=>rand(0,1)
        ]);


    }
}
