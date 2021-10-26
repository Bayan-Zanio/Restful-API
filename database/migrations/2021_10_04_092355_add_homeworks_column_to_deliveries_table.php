<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHomeworksColumnToDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('deliveries', function (Blueprint $table) {
        //     $table->foreignId('homework_id')->constrained('homework', 'id')->nullOnDelete()->after('status');
        // });

        Schema::table('deliveries', function (Blueprint $table) {
            $table->foreignId('homeworks_id')->nullable()->constrained('homework', 'id')->nullOnDelete()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('deliveries', function (Blueprint $table) {
        //     $table->dropColumn('homework');
        // });
        Schema::table('deliveries', function (Blueprint $table) {
            $table->dropColumn('homeworks_id');
        });
    }
}
