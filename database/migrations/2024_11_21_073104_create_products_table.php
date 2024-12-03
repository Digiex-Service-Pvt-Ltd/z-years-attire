<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->enum('product_type', ['single', 'varient'])->default('single');
            $table->integer('parent_id');
            $table->string('product_name', 255);
            $table->string('sku_code', 20)->nullable();
            $table->string('slug', 255);
            $table->text('description')->nullable();
            $table->string('image', 255)->nullable();
            $table->double('price', 10, 2);
            $table->enum('discount_type', ['', 'flat', 'percentage'])->default('');
            $table->string('discount_value', 100)->nullable();
            $table->double('discounted_price', 10, 2)->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->softDeletes(); // Adds a `deleted_at` column
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
        $table->dropSoftDeletes(); // Removes the `deleted_at` column
    }
};
