<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSilabusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('silabuses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('mata_kuliah_id')->references('id')->on('mata_kuliahs')->cascadeOnDelete();
            $table->string('tatap_muka', 50);
            $table->text('kemampuan_akhir');
            $table->longText('keluasan');
            $table->longText('metode_pembelajaran');
            $table->json('estimasi_waktu');
            $table->text('kriteria_penilaian');
            $table->text('pengamalan');
            $table->string('bobot', 4)->nullable();
            $table->string('role');
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
        Schema::dropIfExists('silabuses');
    }
}
