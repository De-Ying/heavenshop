<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('coupon_id');
            $table->string('coupon_name', 50);
            $table->string('coupon_start_date', 50);
            $table->string('coupon_end_date', 50);
            $table->integer('coupon_time');
            $table->integer('coupon_condition');
            $table->integer('coupon_number');
            $table->string('coupon_code', 50)->unique();
            $table->string('coupon_used', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupons');
    }
}
