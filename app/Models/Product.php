<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'price', 'image', 'user_id'];
    protected $attributes = [
        'quantity' => 0,
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
