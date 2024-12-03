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
        Schema::create('meta_management', function (Blueprint $table) {
            $table->id();
            $table->enum('section', ['category', 'product', 'product_listing']);
            $table->integer('item_id');
            $table->text('meta_title');
            $table->text('meta_keywords');
            $table->text('meta_description');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meta_management');
    }
};
