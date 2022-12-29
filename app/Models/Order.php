<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use App\Models\OrderProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','sub_total', 'shipping',
        'total', 'user_name', 'user_email', 
        'user_mobile', 'address', 'city',
        'province', 'country'
    ];

    public function users() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function order_products() {
        return $this->hasMany(OrderProduct::class);
    }
}
