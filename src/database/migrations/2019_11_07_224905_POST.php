<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class POST extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('posts', function (Blueprint $table) {
        $table->bigIncrements('post_id');
        $table->unsignedInteger('id');
        $table->foreign('id')->references('id')->on('users');
        $table->text('post_text');
        $table->string('post_image',500);
        $table->boolean('delete_flag');
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
