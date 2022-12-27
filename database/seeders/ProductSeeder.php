<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'nama' => 'Adidas GX350',
            'harga' => 325000,
            'stok' => 100,
            'isReadyPublish' => 'ready'
        ]);

        Product::create([
            'nama' => 'Adidas GX360',
            'harga' => 355000,
            'stok' => 0,
            'isReadyPublish' => 'not ready'
        ]);

        Product::create([
            'nama' => 'Adidas GX370',
            'harga' => 385000,
            'stok' => 100,
            'isReadyPublish' => 'ready'
        ]);

        Product::create([
            'nama' => 'Adidas GX380',
            'harga' => 425000,
            'stok' => 50,
            'isReadyPublish' => 'ready'
        ]);

        Product::create([
            'nama' => 'Adidas GX390',
            'harga' => 455000,
            'stok' => 0,
            'isReadyPublish' => 'not ready'
        ]);
    }
}
