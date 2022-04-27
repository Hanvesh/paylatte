<?php

namespace Database\Seeders;

use App\Models\Credit;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreditSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()

    { $user = User::all()->random();
        $pan = $user->pancard;

        DB::table('credits')->insert([
            'pancard'=> $pan,
            'credit_score'=> $cr = rand(600,900),
            'gross_revenue'=> $a =  rand(10000,100000),
            'liabilties'=> $b = rand(2000,50000),
            'networth'=>$c = $a - $b,
            'credit_limit'=>(int)$this->limit($cr,$c)

        ]);
    }

        function limit($i, $x)
        {
            if ($i >= 600 && $i <= 900) {
                if ($x >= 2000 && $x <= 10000) {
                    return ($i / 900) * 12000;
                } elseif ($x > 10000 && $x <= 30000) {
                    return ($i / 900) * 24000;
                } elseif ($x > 30000 && $x <= 50000) {
                    return ($i / 900) * 36000;
                } elseif ($x > 50000) {
                    return ($i / 900) * 54000;
                } else
                    echo("Risk Credit Score");
            }
        }

}
