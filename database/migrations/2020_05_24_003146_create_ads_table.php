<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 60);
            $table->string('description', 255);
            // ads categories foreign
            $table->integer('ads_category_id')->unsigned();
            $table->foreign('ads_category_id')->references('id')->on('ads_categories')
            ->onUpdate('cascade')->onDelete('cascade');
            // users foreign
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')
            ->onUpdate('cascade')->onDelete('cascade');
            // member foreign
            $table->integer('member_id')->unsigned()->nullable();
            $table->foreign('member_id')->references('id')->on('members')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedInteger('views')->nullable();
            $table->longText('content');
            $table->string('image', 70);
            $table->enum('status', ['published' , 'pending'])->default('pending');
            $table->timestamp('approved_at')->nullable();
            $table->integer('approved_by')->unsigned()->nullable();
            $table->foreign('approved_by')->references('id')->on('users');
            $table->string('address', 36);
            $table->enum('purchase_type', ['paid' , 'free']);
            $table->unsignedInteger('price')->nullable();
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
        Schema::dropIfExists('ads');
    }
}
