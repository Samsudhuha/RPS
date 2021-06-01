<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosenMataKuliahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dosen_mata_kuliahs', function (Blueprint $table) {
            $table->foreignUuid('dosen_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignUuid('mata_kuliah_id')->references('id')->on('mata_kuliahs')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dosen_mata_kuliahs');
    }
}
