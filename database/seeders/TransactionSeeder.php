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
        $credit = User::all()->random()->where('id','=',755496681904340993)->first();
        $pan = $credit->pancard;
        $panc = DB::table('credits')->select('credit_limit')
            ->where('pancard','=',$pan)->first();
        $limit = $panc->credit_limit;
        $vendor = Vendor::all()->random();
        $vendor_id = $vendor->id;
        //$item = Item::all()->random();
        //$item_cost =$item->item_cost ;

        $arr =['repayment','refund','debit'];

        DB::table('transactions')->insert([
            'sender_id' => $a =   "755496681904340993",
            'receiver_id' => "755497130303586305",
            'transaction_type'=>"debit",
            'transaction_amount' => $tr = 0,
            'transaction_status' => $ts = rand(0,1),
            'transaction_date' => $faker->dateTimeBetween('-2 years'),
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
