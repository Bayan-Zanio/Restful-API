<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClaasUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // claas_user
        Schema::create('claas_user', function (Blueprint $table) {
            $table->foreignId('claas_id')->constrained('claas' , 'id')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users' , 'id')->cascadeOnDelete();
            $table->primary(['claas_id' , 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('claas_users');
    }
}
