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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('sub_category_id')->nullable();
            $table->string('name', 50);
            $table->string('slug', 50);
            $table->string('sku', 50);
            $table->string('title', 50)->nullable();
            $table->string('price', 50)->nullable();
            $table->string('discount_price', 50)->nullable();
            $table->string('perchese_quantity', 50)->nullable();
            $table->string('available_quantity', 50)->nullable();
            // $table->string('colors', 1000)->nullable();
            $table->enum('remark', ["End of Season", "Winter Sale", "Top Sales", "popular", "Flash Deal", "Rain Sale", "Hot Sale"])->nullable();
            $table->unsignedBigInteger('collection_id')->nullable();
            $table->enum('refundable', ['yes', 'no']);
            $table->enum('status', ['publish', 'unpublish'])->default('publish');
            $table->longText('description')->nullable();
            $table->longText('specification')->nullable();
            $table->string('image_url')->nullable();

            // that's column for seo
            $table->string('meta_tag', 1000)->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();

            $table->foreign('brand_id')->references('id')->on('brands')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('sub_category_id')->references('id')->on('sub_categories')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('collection_id')->references('id')->on('collections')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
