<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUploadRelatedTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('uploads', function (Blueprint $table) {
          $table->increments('id');
          $table->string('location');
          $table->string('type');
          $table->timestamps();
      });

      Schema::create('uploads_users', function (Blueprint $table) {
         $table->integer('upload')->unsigned();
         $table->integer('user')->unsigned();
         $table->foreign('upload')
           ->references('id')
           ->on('uploads')
           ->onDelete('cascade');
         $table->foreign('user')
           ->references('id')
           ->on('users')
           ->onDelete('cascade');
       $table->primary(['upload', 'user']);
       });

       Schema::create('uploads_courses', function (Blueprint $table) {
          $table->integer('upload')->unsigned();
          $table->integer('course')->unsigned();
          $table->foreign('upload')
            ->references('id')
            ->on('uploads')
            ->onDelete('cascade');
          $table->foreign('course')
            ->references('id')
            ->on('courses')
            ->onDelete('cascade');
        $table->primary(['upload', 'course']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('uploads');
      Schema::dropIfExists('uploads_courses');
      Schema::dropIfExists('uploads_users');
    }
}
