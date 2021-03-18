<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCpmksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cpmks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('mata_kuliah_id')->references('id')->on('mata_kuliahs')->cascadeOnDelete();
            $table->longText('name');
            $table->integer('no');
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
        Schema::dropIfExists('cpmks');
    }
}
