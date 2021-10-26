<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialsUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_user', function (Blueprint $table) {
            $table->foreignId('material_id')->constrained('claas' , 'id')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users' , 'id')->cascadeOnDelete();
            $table->primary(['material_id' , 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materials_user');
    }
}
