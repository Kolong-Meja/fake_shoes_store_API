<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'product_id', 'price', 
        'quantity', 'sub_total', 'shipping',
        'total', 'user_name', 'user_email', 
        'user_mobile', 'address', 'city',
        'province', 'country'
    ];

    public function users() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function products() {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function setSubTotalAttribute() {
        $this->attributes['sub_total'] = $this->price * $this->quantity;
    }

    public function setTotalAttribute() {
        $this->attributes['total'] = $this->sub_total + $this->shipping;
    }
          
}
