<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('contact_id');
            $table->string('contact_address', 100);
            $table->char('contact_phone', 20)->unique();
            $table->string('contact_email', 100)->unique();
            $table->string('contact_url_fanpage', 100);
            $table->text('contact_map');
            $table->text('contact_fanpage');
            $table->integer('contact_status')->default('1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
