<?php

namespace Database\Factories;

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
    {
        $credit = [
            'pancard' => User::all()->pluck('pancard')->random(),
            'credit_score' => $this->faker->numberBetween(300, 900),
            'gross_revenue' => $this->faker->numberBetween(10000, 1000000),
            'liabilties' => $this->faker->numberBetween(2000, 50000),
        ];
        $credit['difference'] = $credit['gross_revenue'] - $credit['liabilties'];
        $credit['credit_limit'] = (int)$this->limit($credit['credit_score'], $credit['difference']);
        return $credit;
    }

    function difference($a, $b)
    {
        if ($b != 0) {
            $a -= $b;
        }
        return $a;
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
