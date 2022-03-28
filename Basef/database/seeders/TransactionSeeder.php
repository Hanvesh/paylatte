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
        $user = User::all()->random();
        $user_id = $user->id;
        $vendor = Vendor::all()->random();
        $vendor_id = $vendor->id;
        $credit = Credit::all()->random();
        $limit = $credit->credit_limit;
        $item = Item::all()->random();
        $item_cost =$item->item_cost ;

        $arr =['repayment','refund','debit'];

        DB::table('transactions')->insert([
            'sender_id' =>  $user_id,
            'receiver_id' => $vendor_id,
            'transaction_type'=>Arr::random($arr),
            'credit_limit'=>$limit,
            'transaction_amount' => $tr = $item_cost,
            'transaction_status' => $ts = rand(0,1),
            'transaction_date' => $faker->dateTimeBetween('-2 years'),
            'credit_balance' => $this->diff($ts,$limit,$tr),
        ]);
    }
    function diff($a,$b,$c){
        if (($a ==1) and ($b > $c)){
            $b = $b - $c;
        }
        return $b;

    }

}
