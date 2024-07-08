<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gallery_category_id');
            $table->string('image_name', 50)->nullable();
            $table->string('image_extention', 50)->nullable();
            $table->string('image_size', 50)->nullable();
            $table->string('file_type', 50)->nullable();
            $table->string('url')->nullable();
            $table->foreign('gallery_category_id')->references('id')->on('gallery_categories')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};
