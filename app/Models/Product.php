<?php

namespace App\Models;

use App\Traits\HandleImageTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, HandleImageTrait;

    protected $fillable = [
        'name',
        'description',
        'sale',
        
    ];

    // public function details()
    // {
    //     return $this->hasMany(ProductDetail::class);
    // }


    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function assignCategory($categoryIds)
    {
        return $this->categories()->sync($categoryIds);
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_sizes')
                    ->withPivot('price');
    }

    public function assignSize($sizeIds)
    {
        return $this->sizes()->sync($sizeIds);
    }

    public function getBy($datasearch, $categoryId)
    {
        return $this->whereHas('categories',fn($q) => $q->where('category_id', $categoryId))->paginate(8);
    }

    public function getImagePathAttribute()
    {
       return asset($this->images->count() > 0 ? 'upload/' . $this->images->first()->url : 'upload/default.png');
    }

    public function getSalePriceAttribute()
    {
        return $this->attributes['sale'] ? $this->attributes['price'] - ($this->attributes['sale'] * 0.01  * $this->attributes['price']) : 0;
    }

//     public function carts()
// {
//     return $this->belongsToMany(Cart::class, 'cart_product');
// }
}
