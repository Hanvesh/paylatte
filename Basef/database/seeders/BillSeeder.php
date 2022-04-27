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
            'bill_amount'=>(int)$this->processfee($bill),
            'bill_due_date'=> now(),
            'bill_status'=>1
        ]);



    }
    function processfee($bill){
        if($bill >=1 && $bill <=1000){
            $bill  +=(0.02 * $bill);
                return $bill;
        }
        if($bill >=1001 && $bill <=5000){
            $bill  +=(0.04 * $bill);
            return $bill;
        }
        if($bill >=5001 && $bill <=10000){
            $bill  +=(0.06 * $bill);
            return $bill;
        }
        if($bill >10000){
            $bill  +=(0.08 * $bill);
            return $bill;
        }
    }
}
