<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('comment_id');
            $table->text('comment_content');
            $table->integer('comment_like')->default('0');
            $table->integer('comment_dislike')->default('0');
            $table->integer('comment_status')->default('1');
            $table->integer('parent_id')->unsigned()->nullable();
            $table->integer('admin_id')->unsigned()->nullable();
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('customer_id');
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
            $table->foreign('customer_id')->references('customer_id')->on('customers')->onDelete('cascade');
            $table->timestamp('comment_date')->default(DB::raw('CURRENT_TIMESTAMP'));

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
