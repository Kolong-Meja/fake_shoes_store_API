<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id", "nama", "harga", "stok", "isReadyPublish"
    ];

    public function users() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
