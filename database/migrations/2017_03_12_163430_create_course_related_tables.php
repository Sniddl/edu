<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseRelatedTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->date('end_date');
            $table->string('end_time');
            $table->float('price',5,2);
            $table->date('start_date');
            $table->string('start_time');
            $table->string('student_access_code');
            $table->string('subject');
            $table->string('syllabus')->default('/default/syllabus');
            $table->string('teacher');
            $table->timestamps();
        });

        Schema::create('courses_students', function (Blueprint $table) {
           $table->integer('course')->unsigned();
           $table->integer('student')->unsigned();
           $table->foreign('course')
             ->references('id')
             ->on('courses')
             ->onDelete('cascade');
           $table->foreign('student')
             ->references('id')
             ->on('students')
             ->onDelete('cascade');
         $table->primary(['course', 'student']);
         });

         Schema::create('courses_teachers', function (Blueprint $table) {
            $table->integer('course')->unsigned();
            $table->integer('teacher')->unsigned();
            $table->foreign('course')
              ->references('id')
              ->on('courses')
              ->onDelete('cascade');
            $table->foreign('teacher')
              ->references('id')
              ->on('teachers')
              ->onDelete('cascade');
          $table->primary(['course', 'teacher']);
          });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
        Schema::dropIfExists('courses_students');
        Schema::dropIfExists('courses_teachers');
    }
}
