<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMataKuliahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mata_kuliahs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('pt_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignUuid('program_studi_id')->references('id')->on('program_studis')->cascadeOnDelete();
            $table->foreignUuid('fakultas_id')->references('id')->on('fakultases')->cascadeOnDelete();
            $table->foreignUuid('jurusan_id')->references('id')->on('jurusans')->cascadeOnDelete();
            $table->foreignUuid('rmk_id')->references('id')->on('rmks')->cascadeOnDelete();
            $table->string('kode', 10);
            $table->string('name', 150);
            $table->string('bobot', 1);
            $table->string('semester', 1);
            $table->longText('deskripsi')->nullable();
            $table->json('bahan_kajian')->nullable();
            $table->json('pustaka')->nullable();
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
        Schema::dropIfExists('mata_kuliahs');
    }
}
