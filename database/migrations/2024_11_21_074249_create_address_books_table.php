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
        Schema::create('address_books', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->string('title', 255);
            $table->string('address1', 255);
            $table->string('address2', 255);
            $table->string('country', 15);
            $table->string('city', 100);
            $table->string('state', 100);
            $table->string('pincode', 20);
            $table->tinyInteger('is_default')->default(0);
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
        Schema::dropIfExists('address_books');
    }
};
