<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Create url database table
 * @author Diego Andre Poli <diegoandrepoli@gmail.com>
 */
class UrlsTable extends Migration {
    
    /**
     * Run the up migrations.
     * @return void
     */
    public function up() {
        Schema::create('lk_urls', function (Blueprint $table) {
            $table->increments('id');           
            $table->bigInteger('hits')->default(0);          
            $table->string('user_id')->references('id')->on('lk_users');
            $table->string('url');
            $table->string('shortUrl');                        
            $table->timestamps();                     
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down() {
        Schema::dropIfExists('lk_urls');
    }
}
