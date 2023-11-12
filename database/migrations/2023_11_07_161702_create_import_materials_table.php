<?php

use App\Models\Material;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('import_materials', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Supplier::class)->constrained()->cascadeOnDelete();
            
            $table->foreignIdFor(Material::class)->constrained()->cascadeOnDelete();
            $table->smallInteger('quantity_entered');
            $table->date('import_date');
            $table->string('importer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('import_materials');
    }
};
