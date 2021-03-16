<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCplCpmksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cpl_cpmks', function (Blueprint $table) {
            $table->foreignUuid('mata_kuliah_id')->references('id')->on('mata_kuliahs')->cascadeOnDelete();
            $table->foreignUuid('cpl_id')->references('id')->on('cpls')->cascadeOnDelete();
            $table->foreignUuid('cpmk_id')->references('id')->on('cpmks')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cpl_cpmks');
    }
}
