<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionRelatedTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('permissions_roles', function (Blueprint $table) {
            $table->integer('permission')->unsigned();
            $table->integer('role')->unsigned();

            $table->foreign('permission')
              ->references('id')
              ->on('permissions')
              ->onDelete('cascade');
            $table->foreign('role')
              ->references('id')
              ->on('roles')
              ->onDelete('cascade');
            $table->primary(['permission', 'role']);
        });

        Schema::create('roles_users', function (Blueprint $table) {
            $table->integer('role')->unsigned();
            $table->integer('user')->unsigned();
            $table->foreign('role')
              ->references('id')
              ->on('roles')
              ->onDelete('cascade');
            $table->foreign('user')
              ->references('id')
              ->on('users')
              ->onDelete('cascade');
            $table->primary(['role', 'user']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('permissions_roles');
        Schema::dropIfExists('roles_users');
    }
}
