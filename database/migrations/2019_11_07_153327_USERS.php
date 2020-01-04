<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class USERS extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('users', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name',255);
        $table->string('email',191)->unique();
        $table->string('password',255);
        $table->string('image_url',500)->nullable();
        $table->text('profile')->nullable();
        $table->rememberToken();
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
      Schema::dropIfExists('users');
    }
}
