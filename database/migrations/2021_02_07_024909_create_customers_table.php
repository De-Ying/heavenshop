<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('customer_id');
            $table->string('customer_name', 50);
            $table->string('customer_image', 100)->nullable();
            $table->char('customer_phone', 20);
            $table->string('customer_address', 100);
            $table->string('customer_email', 100)->unique();
            $table->string('customer_password', 100);
            $table->integer('customer_vip')->default('0');
            $table->integer('customer_social')->default('0');
            $table->integer('customer_status')->default('1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
