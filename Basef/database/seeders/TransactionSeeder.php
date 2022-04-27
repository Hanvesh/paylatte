<?php

namespace Database\Seeders;

use App\Models\Credit;
use App\Models\Item;
use App\Models\Refund;
use App\Models\Repayment;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Vendor;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $credit = User::all()->where('id','=', 756812974510309377)->first();
        $pan = $credit->pancard;
        $panc = DB::table('credits')->select('credit_limit')
            ->where('pancard','=',$pan)->first();
        $limit = $panc->credit_limit;
        $vendor = Vendor::all()->random();
        $vendor_id = $vendor->id;
        //$item = Item::all()->random();
        //$item_cost =$item->item_cost ;


        DB::table('transactions')->insert([
            'sender_id' => "756812974510309377",
            'receiver_id' => "756813458726846465",
            'transaction_type'=>"debit",
            'transaction_amount' => $tr = 0,
            'transaction_status' => $ts = 1,
            'transaction_date' => now(),
            'credit_balance' => $limit

        ]);
    }
    function diff($a,$b,$c){
        if(($a==1) and($b >$c)){
            $b = $b - $c;
        }
        return $b;

    }
}
