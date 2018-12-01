<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * User create database table
 * @author Diego Andre Poli <diegoandrepoli@gmail.com>
 */
class CreateUsersTable extends Migration {
    
    /**
     * Run the up migrations.
     */
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations
     * @return void
     */
    public function down() {
        Schema::dropIfExists('users');
    }
}
