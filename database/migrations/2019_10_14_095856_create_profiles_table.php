<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->text('image');
            $table->text('template');
            $table->text('fullname');
            $table->text('title');
            $table->text('bio');
            $table->text('social_provider');
            $table->text('social_url');
            $table->text('add_contact')->nullable();
            $table->text('add_video')->nullable();
            $table->text('add_extra_url')->nullable();
            $table->string('url')->unique();
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
        Schema::dropIfExists('profiles');
    }
}
