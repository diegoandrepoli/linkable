<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Create passord reset database table
 * @author Diego Andre Poli <diegoandrepoli@gmail.com>
 */
class CreatePasswordResetsTable extends Migration {
    
    /**
     * Run the up migrations.
     * @return void
     */
    public function up() {
        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token')->index();
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down() {
        Schema::dropIfExists('password_resets');
    }
}
