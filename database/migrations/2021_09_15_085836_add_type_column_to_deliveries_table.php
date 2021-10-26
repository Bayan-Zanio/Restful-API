<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeColumnToDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('deliveries', function (Blueprint $table) {
        //     $table->foreignId('homework_id')->constrained('homework','id')->nullOnDelete();
            
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('deliveries', function (Blueprint $table) {
        //     $table->dropColumn('homework_id');
        // });
    }
}
