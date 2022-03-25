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
use Illuminate\Support\Facades\DB;

class RepaymentTransSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { $faker =Factory::create();
        $user = User::all()->random();
        $user_id = $user->id;

        $credit = Credit::all()->random();
        $limit = $credit->credit_limit;

        $repayment = Repayment::all()->random();
        $repayment_id = $repayment->id;
        $repayment_status=$repayment->repayment_status;
        $repayment_cost = $repayment->repayment_amount;
        if($repayment_status == true) {
            DB::table('transactions')->insert([
                'id' => $repayment_id,
                'sender_id' => $user_id,
                'receiver_id' => '1612512120205',
                'transaction_type' => 'repayment',
                'credit_limit' => $limit,
                'transaction_amount' => $repayment_cost,
                'transaction_status' => 1,
                'transaction_date' => $faker->dateTimeBetween('-2 years'),
                'credit_balance' => $limit,
            ]);
        }
    }
}
