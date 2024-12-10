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
        Schema::table('product_categories', function (Blueprint $table) {
            // Adding the foreign key constraint
            $table->foreign('product_id')
            ->references('id')
            ->on('products')
            ->onDelete('cascade'); // Set action on delete

            // Adding the foreign key constraint
            $table->foreign('category_id')
            ->references('id')
            ->on('categories')
            ->onDelete('cascade'); // Set action on delete
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_categories', function (Blueprint $table) {
            $table->dropForeign(['product_id']); // Drops the foreign key
            $table->dropForeign(['category_id']); // Drops the foreign key
        });
    }
};
