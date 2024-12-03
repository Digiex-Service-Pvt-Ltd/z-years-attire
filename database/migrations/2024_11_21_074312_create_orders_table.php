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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->string('order_number', 30);
            $table->dateTime('order_date', $precision = 0);
            $table->double('order_amount', 10, 2);
            $table->string('billing_name', 255);
            $table->string('billing_address1', 255);
            $table->string('billing_address2', 255);
            $table->string('billing_country', 50);
            $table->string('billing_state', 100);
            $table->string('billing_city', 100);
            $table->string('billing_pincode', 15);
            $table->string('shipping_name', 255);
            $table->string('shipping_address1', 255);
            $table->string('shipping_address2', 255);
            $table->string('shipping_country', 50);
            $table->string('shipping_state', 100);
            $table->string('shipping_city', 100);
            $table->string('shipping_pincode', 15);
            $table->enum('status', ['pending', 'completed', 'cancelled']);
            $table->enum('payment_mode', ['COD', 'ONLINE']);
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
        Schema::dropIfExists('orders');
    }
};
