<?php

namespace App\Models;

use App\Models\User;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id", "title", "meta_title",
        "slug", "description", "price", 
        "weight", "volume", "size", 
        "color", "stock", "isReadyPublish"
    ];

    public function users() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orders() {
        return $this->belongsToMany(Order::class, 'order_products');
    }
}
