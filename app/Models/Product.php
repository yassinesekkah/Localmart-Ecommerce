<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Like;

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

    public function seller()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function isLikeBy($user)
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function isFavoriteBy($user)
    {
        if (!$user) return false;
        return $this->favorites()->where('user_id', $user->id)->exists();
    }


    public function reviews()
    {
        return $this->hasMany(Reviews::class);
    }
}
