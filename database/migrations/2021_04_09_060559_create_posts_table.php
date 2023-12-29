<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('post_id');
            $table->text('post_title');
            $table->string('post_image', 100)->nullable();
            $table->string('post_slug', 100)->unique();
            $table->text('post_description');
            $table->text('post_content');
            $table->timestamp('post_date')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Ngày tạo');
            $table->integer('post_view')->default('0');
            $table->integer('post_status')->default('1');
            $table->string('post_author', 50);
            $table->unsignedInteger('category_post_id');
            $table->foreign('category_post_id')->references('category_post_id')->on('category_posts')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
