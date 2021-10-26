<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            //$table->morphs('imageable');
            $table->foreignId('homework_id')->nullable()->constrained('homework')->cascadeOnDelete();
            $table->foreignId('activities_id')->nullable()->constrained('activities')->cascadeOnDelete();
            $table->foreignId('deliveries_id')->nullable()->constrained('deliveries')->cascadeOnDelete();
            $table->string('image_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
}
