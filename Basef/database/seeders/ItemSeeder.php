<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->insert([
            'id'=>'1',
            'item_name'=>'Casio Watch',
            'item_cost'=>'1000',
            'available_quantity'=>'100',
        ]);
        DB::table('items')->insert([
            'item_name'=>'Mi Band 4',
            'item_cost'=>'5000',
            'available_quantity'=>'100',
        ]);
        DB::table('items')->insert([
            'item_name'=>'Vivo x55',
            'item_cost'=>'10000',
            'available_quantity'=>'100',
        ]);
        DB::table('items')->insert([
            'item_name'=>'Boat HeadSet',
            'item_cost'=>'3000',
            'available_quantity'=>'100',
        ]);
        DB::table('items')->insert([
            'item_name'=>'Nike Shoe',
            'item_cost'=>'9000',
            'available_quantity'=>'100',
        ]);
        DB::table('items')->insert([
            'item_name'=>'Parada T-Shirt',
            'item_cost'=>'2000',
            'available_quantity'=>'100',
        ]);
        DB::table('items')->insert([
            'item_name'=>'Blazzer',
            'item_cost'=>'5000',
            'available_quantity'=>'100',
        ]);
        DB::table('items')->insert([
            'item_name'=>'Baskin-Robins Cone',
            'item_cost'=>'200',
            'available_quantity'=>'100',
        ]);
    }
}
