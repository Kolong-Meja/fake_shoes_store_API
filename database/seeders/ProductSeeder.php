<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\User;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $admin = User::select('id', 'role')->where('role', 'admin')->first();

        Product::create([
            'user_id' => $admin->id,
            'nama' => 'Adidas GX350',
            'harga' => 325000,
            'stok' => 100,
            'isReadyPublish' => 'ready'
        ]);

        Product::create([
            'user_id' => $admin->id,
            'nama' => 'Adidas GX360',
            'harga' => 355000,
            'stok' => 0,
            'isReadyPublish' => 'not ready'
        ]);

        Product::create([
            'user_id' => $admin->id,
            'nama' => 'Adidas GX370',
            'harga' => 385000,
            'stok' => 100,
            'isReadyPublish' => 'ready'
        ]);

        Product::create([
            'user_id' => $admin->id,
            'nama' => 'Adidas GX380',
            'harga' => 425000,
            'stok' => 50,
            'isReadyPublish' => 'ready'
        ]);

        Product::create([
            'user_id' => $admin->id,
            'nama' => 'Adidas GX390',
            'harga' => 455000,
            'stok' => 0,
            'isReadyPublish' => 'not ready'
        ]);
    }
}
