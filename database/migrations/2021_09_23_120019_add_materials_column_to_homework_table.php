<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMaterialsColumnToHomeworkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('homework', function (Blueprint $table) {
            $table->foreignId('materiales')->nullable()->constrained('materials', 'id')->nullOnDelete()->after('duration');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('homework', function (Blueprint $table) {
            $table->dropColumn('materiales');
        });
    }
}
