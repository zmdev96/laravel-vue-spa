<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreateEmailVerificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_verifications', function (Blueprint $table) {
            $table->increments('id');
            // member foreign
            $table->integer('member_id')->unsigned();
            $table->foreign('member_id')->references('id')->on('members')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->string('token', 40);
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
        Schema::dropIfExists('email_verifications');
    }
}
