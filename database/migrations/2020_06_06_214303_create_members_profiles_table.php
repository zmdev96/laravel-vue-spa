<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id')->unsigned()->unique();
            $table->foreign('member_id')->references('id')->on('members')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->string('city', 24);
            $table->string('address', 36);
            $table->string('phone', 15);
            $table->date('birth_year');
            $table->longText('about', 15)->nullable();
            $table->string('image', 70)->nullable();
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
        Schema::dropIfExists('members_profiles');
    }
}
