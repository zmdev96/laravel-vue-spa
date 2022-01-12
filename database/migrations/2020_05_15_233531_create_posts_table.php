<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
          $table->increments('id');
          $table->string('title', 60);
          $table->string('description', 255);
          // sub categories foreign
          $table->integer('sub_category_id')->unsigned();
          $table->foreign('sub_category_id')->references('id')->on('sub_categories')
          ->onUpdate('cascade')->onDelete('cascade');
          // users foreign
          $table->integer('user_id')->unsigned()->nullable();
          $table->foreign('user_id')->references('id')->on('users')
          ->onUpdate('cascade')->onDelete('cascade');
          // member foreign
          $table->integer('member_id')->unsigned()->nullable();
          $table->foreign('member_id')->references('id')->on('members')
          ->onUpdate('cascade')->onDelete('cascade');
          $table->unsignedInteger('views')->default('0');
          $table->longText('content');
          $table->string('image', 70)->nullable();
          $table->enum('status', ['published' , 'pending'])->default('pending');
          $table->timestamp('approved_at')->nullable();
          $table->integer('approved_by')->unsigned()->nullable();
          $table->foreign('approved_by')->references('id')->on('users');
          $table->timestamps();

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
