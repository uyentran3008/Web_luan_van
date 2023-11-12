<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExportMaterial extends Model
{
    use HasFactory;
    protected $fillable =[
        'material_id',
        'export_date',
        'export_quantity',
        'exporter'
    ];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

}
