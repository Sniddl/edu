<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleRelatedTables extends Migration
{

    public function up()
    {

    // =====================================
    // G E N E R A L   T A B L E S
    // =====================================
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cell')->unsigned();
            $table->string('email');
            $table->string('name_first');
            $table->string('name_last');
            $table->integer('phone')->unsigned();
            $table->timestamps();
        });
        Schema::create('parents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('number_of_children')->unsigned();
            $table->string('relationship');
            $table->timestamps();
        });
        Schema::create('people', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('address')->unsigned();
            $table->integer('age')->unsigned();
            $table->date('birth_date');
            $table->string('email');
            $table->string('name_first');
            $table->string('name_middle');
            $table->string('name_last');
            $table->string('name_nick');
            $table->string('sex');
            $table->string('type');
            $table->timestamps();
        });
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('academic_standing');
            $table->string('campus');
            $table->boolean('enrolled');
            $table->double('gpa_cummulative', 4, 4);
            $table->double('gpa_semester', 4, 4);
            $table->integer('graduation'); //year
            $table->string('parent_access_code');
            $table->string('program_of_study');
            $table->timestamps();
        });
        Schema::create('teachers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('degree');
            $table->string('office_number');
            $table->integer('years_worked');
            $table->timestamps();
        });

    // =====================================
    // P I V O T   T A B L E S
    // =====================================
        Schema::create('contacts_people', function (Blueprint $table) {
            $table->integer('contact')->unsigned();
            $table->integer('person')->unsigned();
            $table->foreign('contact')
              ->references('id')
              ->on('contacts')
              ->onDelete('cascade');
            $table->foreign('person')
              ->references('id')
              ->on('people')
              ->onDelete('cascade');
            $table->primary(['contact', 'person']);
        });
        Schema::create('parents_students', function (Blueprint $table) {
            $table->integer('parent')->unsigned();
            $table->integer('student')->unsigned();
            $table->foreign('parent')
              ->references('id')
              ->on('parents')
              ->onDelete('cascade');
            $table->foreign('student')
              ->references('id')
              ->on('students')
              ->onDelete('cascade');
            $table->primary(['parent', 'student']);
        });
        Schema::create('people_parents', function (Blueprint $table) {
            $table->integer('person')->unsigned();
            $table->integer('parent')->unsigned();
            $table->foreign('person')
              ->references('id')
              ->on('people')
              ->onDelete('cascade');
            $table->foreign('parent')
              ->references('id')
              ->on('parents')
              ->onDelete('cascade');
            $table->primary(['person', 'parent']);
        });
        Schema::create('people_students', function (Blueprint $table) {
            $table->integer('person')->unsigned();
            $table->integer('student')->unsigned();
            $table->foreign('person')
              ->references('id')
              ->on('people')
              ->onDelete('cascade');
            $table->foreign('student')
              ->references('id')
              ->on('students')
              ->onDelete('cascade');
            $table->primary(['person', 'student']);
        });
        Schema::create('people_teachers', function (Blueprint $table) {
            $table->integer('person')->unsigned();
            $table->integer('teacher')->unsigned();
            $table->foreign('person')
              ->references('id')
              ->on('people')
              ->onDelete('cascade');
            $table->foreign('teacher')
              ->references('id')
              ->on('teachers')
              ->onDelete('cascade');
            $table->primary(['person', 'teacher']);
        });

    }








    public function down()
    {
        //general tables
        Schema::dropIfExists('contacts');
        Schema::dropIfExists('parents');
        Schema::dropIfExists('people');
        Schema::dropIfExists('students');
        Schema::dropIfExists('teachers');
        //pivot tables
        Schema::dropIfExists('contacts_people');
        Schema::dropIfExists('parents_students');
        Schema::dropIfExists('people_parents');
        Schema::dropIfExists('people_students');
        Schema::dropIfExists('people_teachers');
    }








}
