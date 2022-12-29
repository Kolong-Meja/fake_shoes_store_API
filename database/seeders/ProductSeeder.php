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
        $admin = User::select('id', 'role')->where('role', 'admin')->orWhere('id', 1)->firstOrFail();

        Product::create([
            'user_id' => $admin->id,
            'title' => 'Adidas GX350',
            'meta_title' => 'Sepatu Adidas GX350',
            'slug' => 'sepatu-olahraga-adidas-gx350',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam elementum erat sit amet ipsum venenatis, ac malesuada ipsum vulputate. Donec luctus laoreet ultricies. Aliquam molestie dictum commodo. In vehicula augue vel diam mattis molestie. Donec sed nibh a lectus consequat venenatis. Aliquam pellentesque libero eget leo posuere consectetur. Nulla imperdiet.',
            'price' => 325000.00,
            'weight' => 1.00,
            'size' => 42,
            'color' => 'black & white',
            'stock' => 100,
            'isReadyPublish' => 'ready'
        ]);

        Product::create([
            'user_id' => $admin->id,
            'title' => 'Adidas GX360',
            'meta_title' => 'Sepatu Adidas GX360',
            'slug' => 'sepatu-olahraga-adidas-gx360',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam elementum erat sit amet ipsum venenatis, ac malesuada ipsum vulputate. Donec luctus laoreet ultricies. Aliquam molestie dictum commodo. In vehicula augue vel diam mattis molestie. Donec sed nibh a lectus consequat venenatis. Aliquam pellentesque libero eget leo posuere consectetur. Nulla imperdiet.',
            'price' => 355000.00,
            'weight' => 1.20,
            'size' => 42,
            'color' => 'black & blue',
            'stock' => 50,
            'isReadyPublish' => 'ready'
        ]);

        Product::create([
            'user_id' => $admin->id,
            'title' => 'Adidas GX370',
            'meta_title' => 'Sepatu Adidas GX370',
            'slug' => 'sepatu-olahraga-adidas-gx370',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam elementum erat sit amet ipsum venenatis, ac malesuada ipsum vulputate. Donec luctus laoreet ultricies. Aliquam molestie dictum commodo. In vehicula augue vel diam mattis molestie. Donec sed nibh a lectus consequat venenatis. Aliquam pellentesque libero eget leo posuere consectetur. Nulla imperdiet.',
            'price' => 375000.00,
            'weight' => 1.10,
            'size' => 43,
            'color' => 'white & pink',
            'stock' => 50,
            'isReadyPublish' => 'ready'
        ]);

        Product::create([
            'user_id' => $admin->id,
            'title' => 'Adidas GX380',
            'meta_title' => 'Sepatu Adidas GX380',
            'slug' => 'sepatu-olahraga-adidas-gx380',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam elementum erat sit amet ipsum venenatis, ac malesuada ipsum vulputate. Donec luctus laoreet ultricies. Aliquam molestie dictum commodo. In vehicula augue vel diam mattis molestie. Donec sed nibh a lectus consequat venenatis. Aliquam pellentesque libero eget leo posuere consectetur. Nulla imperdiet.',
            'price' => 425000.00,
            'weight' => 1.00,
            'size' => 42,
            'color' => 'black & pink',
            'stock' => 100,
            'isReadyPublish' => 'ready'
        ]);

        Product::create([
            'user_id' => $admin->id,
            'title' => 'Adidas GX390',
            'meta_title' => 'Sepatu Adidas GX390',
            'slug' => 'sepatu-olahraga-adidas-gx390',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam elementum erat sit amet ipsum venenatis, ac malesuada ipsum vulputate. Donec luctus laoreet ultricies. Aliquam molestie dictum commodo. In vehicula augue vel diam mattis molestie. Donec sed nibh a lectus consequat venenatis. Aliquam pellentesque libero eget leo posuere consectetur. Nulla imperdiet.',
            'price' => 385000.00,
            'weight' => 1.10,
            'size' => 44,
            'color' => 'white & red',
            'stock' => 50,
            'isReadyPublish' => 'not ready'
        ]);
    }
}
