<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'size_id', 'product_id', 'product_quantity', 'order_id', 'user_id'
    ];

    public function size()
    {
        return $this->belongsTo(Size::class,'size_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // public function productSize()
    // {
    //     return $this->belongsToMany(ProductSize::class)->withPivot('price');
    // }
}
