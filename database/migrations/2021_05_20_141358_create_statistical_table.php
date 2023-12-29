<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatisticalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistical', function (Blueprint $table) {
            $table->increments('statistical_id');
            $table->string('order_date', 50);
            $table->string('funds', 50);
            $table->string('sales', 50);
            $table->string('profit', 50);
            $table->integer('quantity');
            $table->integer('total_order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statistical');
    }
}
