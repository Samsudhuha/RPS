<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMataKuliahSyaratsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mata_kuliah_syarats', function (Blueprint $table) {
            $table->foreignUuid('mata_kuliah_id')->references('id')->on('mata_kuliahs')->cascadeOnDelete();
            $table->foreignUuid('mata_kuliah_syarat_id')->references('id')->on('mata_kuliahs')->cascadeOnDelete();
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
        Schema::dropIfExists('mata_kuliah_syarats');
    }
}
