<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dosens', function (Blueprint $table) {
            $table->foreignUuid('id')->references('id')->on('users')->cascadeOnDelete()->primary();
            $table->foreignUuid('program_studi_id')->references('id')->on('program_studis')->cascadeOnDelete();
            $table->foreignUuid('fakultas_id')->references('id')->on('fakultases')->cascadeOnDelete();
            $table->foreignUuid('jurusan_id')->references('id')->on('jurusans')->cascadeOnDelete();
            $table->foreignUuid('rmk_id')->references('id')->on('rmks')->cascadeOnDelete();
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
        Schema::dropIfExists('dosens');
    }
}
