<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductSize extends Pivot
{
    protected $table = 'product_sizes';

    protected $fillable = ['product_id', 'size_id', 'price'];

    
}
