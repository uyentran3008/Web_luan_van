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

    // public function products()
    // {
    //     return $this->belongsToMany(Product::class, 'cart_products', 'cart_id', 'product_id')->withPivot('size_id', 'product_quantity');
    // }
    public function products()
    {
        return $this->hasMany(CartProduct::class, 'cart_id');
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
            $cart = $this->create(['user_id' => $userId]);
        }
        return $cart;
    }

    public function getProductCountAttribute()
    {
        return auth()->check() ? $this->products->count() : 0;
    }
    
    public function getTotalPriceAttribute()
    {
        return auth()->check() ? $this->products->reduce(function ($carry, $item){
            $item->load('product');
            $price = $item->product_quantity * ($item->product->sale ?  $item->product->sizes()->where('name', $item->size->name)->first()->pivot->price - ($item->product->sizes()->where('name', $item->size->name)->first()->pivot->price  * 0.01 * $item->product->sale) 
            :  $item->product->sizes()->where('name', $item->size->name)->first()->pivot->price );
            return $carry + $price;
        },0) : 0;
    }

    // public function cartProducts() {
    //     return $this->hasMany(CartProduct::class, 'cart_id','id');
    // }
}
