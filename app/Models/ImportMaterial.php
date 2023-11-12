<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportMaterial extends Model
{
    use HasFactory;
    protected $fillable = [
        'supplier_id',
        'material_id',
        'quantity_entered',
        'import_date',
        'importer'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function assignSupplier($supplierIds)
    {
        return $this->supplier()->sync($supplierIds);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function assignMaterial($materialIds)
    {
        return $this->material()->sync($materialIds);
    }

    
}
