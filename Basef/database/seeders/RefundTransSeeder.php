<?php

namespace Database\Seeders;

use App\Models\Credit;
use App\Models\Item;
use App\Models\Refund;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Vendor;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class RefundTransSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { $faker = Factory::create();
        $user = User::all()->random();
        $user_id = $user->id;
        $vendor = Vendor::all()->random();
        $vendor_id = $vendor->id;
        $credit = Credit::all()->random();
        $limit = $credit->credit_limit;
        $item = Item::all()->random();
        $item_cost =$item->item_cost ;
        $refund = Refund::all()->random();
        $refund_id = $refund->id;
        $refund_cost=$refund->refund_amount;
        $refund_status=$refund->refund_status;
        $refund_trans = Transaction::all()->random();
        $refund_bal = $refund_trans->credit_balance;

if($refund_status == true) {
    DB::table('transactions')->insert([
        'id' => $refund_id,
        'sender_id' => $vendor_id,
        'receiver_id' => $user_id,
        'transaction_type' => 'refund',
        'credit_limit' => $limit,
        'transaction_amount' => $refund_cost,
        'transaction_status' => 1,
        'transaction_date' =>$faker->dateTimeBetween('-2 years'),
        'credit_balance' => $this->summ($limit,$refund_bal,$refund_cost),
    ]);
}
    }
    function summ($a,$b,$c){
        if($a > $b){
            $b = $b + $c;
        }
        return $b;
    }


}
