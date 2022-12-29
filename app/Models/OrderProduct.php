<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'order_id',
        'price', 'quantity'
    ];

    public function orders() {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function products() {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
