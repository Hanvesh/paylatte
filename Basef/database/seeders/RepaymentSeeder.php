<?php

namespace Database\Seeders;

use App\Models\Repayment;
use Illuminate\Database\Seeder;

class RepaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Repayment::factory(10)->create();
    }
}
