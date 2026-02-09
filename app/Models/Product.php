<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
      protected $fillable = [
        'name',
        'slug',
        'price',
        'quantity',
        'description',
        'image',
        'category_id',
        'user_id',
    ];
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function likes() {
        return $this->hasMany(Like::class);
    }

    public function isLikeBy($user) {
        return $this->likes()->where('user_id', $user->id )->exists();
    }
}
