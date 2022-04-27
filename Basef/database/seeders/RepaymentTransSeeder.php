<?php

namespace Database\Seeders;

use App\Models\Bill;
use App\Models\Credit;
use App\Models\Item;
use App\Models\Refund;
use App\Models\Repayment;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Vendor;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RepaymentTransSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::all()->random();
        $user_id = $user->id;
        $pan = $user->pancard;

        $bill = Bill::all()->where('user_id','=',$user_id)->first();
        $bill_id = $bill->id;
        $rt = DB::table('transactions')->select('credit_balance')
            ->where('sender_id','=',$user_id)
            ->orderBy('transaction_date','desc')->first();
        $r = $rt->credit_balance;
        $repayment = Repayment::all()->where('bill_id','=',$bill_id)->first();
        $repayment_id = $repayment->id;
        $repayment_status=$repayment->repayment_status;
        $repayment_cost = $repayment->repayment_amount;
        $repayment_date = $repayment->repayment_date;
        if($repayment_status) {
            DB::table('transactions')->insert([
                'id' => $repayment_id,
                'sender_id' => $user_id,
                'receiver_id' => '1612512120205',
                'transaction_type' => 'repayment',
                'transaction_amount' => $repayment_cost,
                'transaction_status' => 1,
                'transaction_date' => $repayment_date,
                'credit_balance' => $r + $repayment_cost,
            ]);
        }
    }
}
