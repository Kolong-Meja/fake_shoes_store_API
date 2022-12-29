<?php

namespace Database\Seeders;

use App\Models\OrderProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderProduct::create([
            'product_id' => 1,
            'order_id' => 1
        ]);

        OrderProduct::create([
            'product_id' => 2,
            'order_id' => 1
        ]);

        OrderProduct::create([
            'product_id' => 1,
            'order_id' => 2
        ]);

        OrderProduct::create([
            'product_id' => 3,
            'order_id' => 2
        ]);

        OrderProduct::create([
            'product_id' => 4,
            'order_id' => 3
        ]);
    }
}
