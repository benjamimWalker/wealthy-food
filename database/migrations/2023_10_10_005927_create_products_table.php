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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('status');
            $table->dateTime('imported_t');
            $table->text('url');
            $table->text('creator');
            $table->timestamp('created_t');
            $table->timestamp('last_modified_t');
            $table->text('product_name');
            $table->string('quantity');
            $table->text('brands');
            $table->text('categories');
            $table->text('labels');
            $table->text('cities');
            $table->text('purchase_places');
            $table->text('stores');
            $table->text('ingredients_text');
            $table->text('traces');
            $table->string('serving_size');
            $table->string('serving_quantity');
            $table->string('nutriscore_score');
            $table->string('nutriscore_grade');
            $table->text('main_category');
            $table->text('image_url');
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
