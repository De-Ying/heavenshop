<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('order_id');
            $table->string('order_code', 50);
            $table->text('order_reason')->nullable();
            $table->string('order_status', 50);
            $table->unsignedInteger('customer_id');
            $table->unsignedInteger('shipping_id');
            $table->foreign('customer_id')->references('customer_id')->on('customers')->onDelete('cascade');
            $table->foreign('shipping_id')->references('shipping_id')->on('shipping')->onDelete('cascade');
            $table->string('order_date', 50);
        });

        Schema::create('order_details', function (Blueprint $table) {
            $table->primary(['product_id','order_id']);
            $table->string('order_code', 50);
            $table->string('product_price', 50);
            $table->integer('product_sales_quantity');
            $table->string('product_coupon', 50);
            $table->string('product_feeship', 50);
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('order_id');
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
            $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade');
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
        Schema::dropIfExists('order_details');
    }
}
