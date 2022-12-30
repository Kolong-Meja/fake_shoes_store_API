<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id", "category_id", "title", "meta_title",
        "slug", "description", "price", 
        "weight", "volume", "size", 
        "color", "stock", "isReadyPublish"
    ];

    public function users() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categories() {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }
}
