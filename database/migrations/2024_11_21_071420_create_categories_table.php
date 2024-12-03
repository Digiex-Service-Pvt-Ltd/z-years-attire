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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('category_name', 255);
            $table->string('slug', 255);
            $table->integer('parent_id');
            $table->string('image', 255)->nullable();
            $table->string('banner_image', 255)->nullable();
            $table->tinyInteger('is_featured')->default(0);
            $table->integer('sort_order');
            $table->text('filtering_attribute_search')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
