<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * User create database table
 * @author Diego Andre Poli <diegoandrepoli@gmail.com>
 */
class UsuariosTable extends Migration {
    
    /**
     * Run the up migrations
     * @return void
     */
    public function up() {
        Schema::create('lk_users', function (Blueprint $table) {           
            $table->string('id')->unique();            
            $table->timestamps();
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lk_users');
    }
}
