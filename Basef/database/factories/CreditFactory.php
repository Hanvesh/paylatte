<?php

namespace Database\Factories;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CreditFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    { $user = User::all();
        $user_id = $user->id;
        $pan = $user->pancard;
        $credit = [
            'pancard' => $pan,
            'credit_score' => $this->faker->numberBetween(600, 900),
            'gross_revenue' => $this->faker->numberBetween(10000, 100000),
            'liabilties' => $this->faker->numberBetween(2000, 50000),
        ];
        $credit['difference'] = $credit['gross_revenue'] - $credit['liabilties'];
        $credit['credit_limit'] = (int)$this->limit($credit['credit_score'], $credit['difference']);
        return $credit;
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
