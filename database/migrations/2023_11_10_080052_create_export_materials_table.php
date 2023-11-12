<?php

use App\Models\Material;
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
        Schema::create('export_materials', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Material::class)->constrained()->cascadeOnDelete();
            $table->smallInteger('export_quantity');
            $table->date('export_date');
            $table->string('exporter');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('export_materials');
    }
};
