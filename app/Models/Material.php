<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'unit_of_measure',
        'price',
        'inventory_number'
    ];

    public function import()
    {
        return $this->hasMany(ImportMaterial::class);
    }

    public function export()
    {
        return $this->hasMany(ExportMaterial::class);
    }

    public function latestImport()
    {
        return $this->hasOne(ImportMaterial::class)->latest();
    }

    public function latestExport()
    {
        return $this->hasOne(ExportMaterial::class)->latest();
    }
}
