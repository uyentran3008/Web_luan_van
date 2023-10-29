<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    use HasFactory;

    protected $table = 'cart_products';
    protected $fillable = [
        'cart_id',
        'product_id',
        'size_id',
        'product_quantity',

    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    // public function sizes()
    // {
    //     return $this->belongsToMany(Size::class, 'product_sizes')
    //                 ->withPivot('price');
    // }
    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }

    public function getBy($cartId, $productId, $sizeId)
    {
        return CartProduct::whereCartId($cartId)->whereProductId($productId)->whereSizeId($sizeId)->first();
    }

    public function getTotalPriceAttribute()
    {
        return   
        $this->product->sale ? $this->product->sizes()->where('name', $this->size->name)->first()->pivot->price - ($this->product->sizes()->where('name', $this->size->name)->first()->pivot->price  * 0.01 * $this->product->sale) * $this->product_quantity 
        : $this->product->sizes()->where('name', $this->size->name)->first()->pivot->price * $this->product_quantity ;
    }



}
