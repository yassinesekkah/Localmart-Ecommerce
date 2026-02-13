<?php

namespace App\Models;

use App\models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    /** @use HasFactory<\Database\Factories\ReviewsFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'comment',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function scopeByProduct($query, $productId)
    {
        return $query->where('product_id', $productId);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}