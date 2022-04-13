<?php

namespace Database\Seeders;

use App\Models\Bill;
use App\Models\Repayment;
use App\Models\Transaction;
use Carbon\Carbon;
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

            'repayment_date'=>$rd=$faker->dateTimeBetween($bill_date,"$bill_date + 2 month"),
            'repayment_amount'=> (int)$this->lateFee($bill_amount,$bill_date,$rd),
            'repayment_status'=>rand(0,1)
        ]);


    }
    function lateFee($bill,$bd,$rd){
        $c = Carbon::parse($bd)->diffInDays(Carbon::parse($rd));
        if($c >30){
            $c = $c -30;
            if($bill >=0 && $bill <= 1500){
                $bill +=($c * 10);
                return $bill;
            }
            if($bill >=1501 && $bill <= 4000){
                $bill +=($c * 15);
                return $bill;
            }
            if($bill >=4001 && $bill <= 6000){
                $bill +=($c * 20);
                return $bill;
            }
            if($bill > 6000 ){
                $bill +=($c * 30);
                return $bill;
            }
        }
        return $bill;
    }
}
