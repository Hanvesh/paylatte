<?php

namespace Database\Seeders;

use App\Models\Credit;
use App\Models\Item;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Seeder;
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
        $user = User::all()->random();
        $user_id = $user->id;
        $vendor = Vendor::all()->random();
        $vendor_id = $vendor->id;
        $credit = Credit::all()->random();
        $limit = $credit->credit_limit;
        $item = Item::all()->random();
        $item_cost =$item->item_cost ;
        DB::table('transactions')->insert([
            'user_id' => $user_id,
            'vendor_id' => $vendor_id,
            'credit_limit'=>$limit,
            'transaction_amount' => $tr = $item_cost,
            'transaction_status' => $ts = rand(0,1),
            'transaction_date' => now(),
            'credit_balance' => $this->diff($ts,$limit,$tr)
        ]);
    }
    function diff($a,$b,$c){
        if (($a ==1) and ($b > $c)){
            $b = $b - $c;
        }
        return $b;

    }
}
