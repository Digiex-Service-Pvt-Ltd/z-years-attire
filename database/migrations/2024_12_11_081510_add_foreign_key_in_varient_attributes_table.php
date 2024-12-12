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
        Schema::table('varient_attributes', function (Blueprint $table) {
            // Adding the foreign key constraint
            $table->foreign('attribute_value_id')
            ->references('id')
            ->on('attribute_values'); // Set action on delete
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('varient_attributes', function (Blueprint $table) {
            $table->dropForeign(['attribute_value_id']); // Drops the foreign key
        });
    }
};
