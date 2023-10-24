<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'cart_products')->withPivot('size_id', 'product_quantity');
    }

    public function getBy($userId)
    {
        return Cart::whereUserId($userId)->first();
    }

    public function firtOrCreateBy($userId)
    {
        $cart = $this->getBy($userId);

        if(!$cart)
        {
            $cart = $this->cart->create(['user_id' => $userId]);
        }
        return $cart;
    }

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    // public function cartProducts()
    // {
    //     return $this->hasMany(CartProduct::class);
    // }
}
