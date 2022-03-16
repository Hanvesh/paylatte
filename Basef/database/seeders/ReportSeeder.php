<?php

namespace Database\Seeders;

use App\Models\Bill;
use App\Models\Credit;
use App\Models\Refund;
use App\Models\Repayment;
use App\Models\Report;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportSeeder extends Seeder
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
        $vendor = Vendor::all()->random();
        $vendor_id = $vendor->id;
        $credit = Credit::all()->random();
        $credit_id = $credit->id;$transaction = Transaction::all()->random();
        $trans_id = $transaction->id;
        $trans_status=$transaction->transaction_status;
        $bill = Bill::all()->random();
        $bill_id = $bill->id;
        $bill_amount=$bill->bill_amount;
        $repayment = Repayment::all()->random();
        $repayment_id = $repayment->id;
        $repayment_status=$repayment->repayment_status;
        $refund = Refund::all()->random();
        $refund_id = $refund->id;
        DB::table('reports')->insert([
            'user_id'=> $user_id,
            'credit_id'=>$credit_id,
            'vendor_id'=>$vendor_id,
            'transaction_id'=>$trans_id,
            'transaction_status'=>$trans_status,
            'bill_id'=>$bill_id,
            'bill_amount'=>$bill_amount,
            'repayment_id'=>$repayment_id,
            'repayment_status'=>$repayment_status,
            'refund_id'=>$refund_id,
        ]);
    }
}
