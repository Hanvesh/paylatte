<?php

namespace Database\Seeders;

use App\Models\Credit;
use Illuminate\Database\Seeder;

class CreditSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Credit::factory(10)->create();
    }
}
