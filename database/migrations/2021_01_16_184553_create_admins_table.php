<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name', 50);
            $table->string('user_name', 30)->unique();
            $table->string('email', 100)->unique();
            $table->string('password', 100);
            $table->string('avatar', 100)->nullable();
            $table->char('phone', 20)->unique();
            $table->string('address', 100);
            $table->boolean('gender');
            $table->integer('status')->default('1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
