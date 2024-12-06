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
        Schema::create('product_varients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->string('variant_name', 255);
            $table->string('sku_code', 255)->nullable();
            $table->double('price', 10, 2);
            $table->integer('stock_qty');
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
        Schema::dropIfExists('product_varients');
        $table->dropSoftDeletes(); // Removes the `deleted_at` column
    }
};
