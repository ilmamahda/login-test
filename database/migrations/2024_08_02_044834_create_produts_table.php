<?php

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
        Schema::create('produts', function (Blueprint $table) {
            $table->id();
            $table->string('brand', 100);
            $table->string('model', 200);
            $table->string('screen_size', 100);
            $table->string('color', 50);
            $table->string('harddisk', 50);
            $table->string('cpu', 100);
            $table->string('ram', 50);
            $table->string('OS', 100);
            $table->string('special_features');
            $table->string('graphics', 50);
            $table->string('graphics_coprocessor', 30);
            $table->string('cpu_speed', 30);
            $table->decimal('rating');
            $table->decimal('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produts');
    }
};
