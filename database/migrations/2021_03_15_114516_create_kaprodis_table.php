<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaprodisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kaprodis', function (Blueprint $table) {
            $table->foreignUuid('dosen_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignUuid('jurusan_id')->references('id')->on('jurusans')->cascadeOnDelete();
            $table->foreignUuid('program_studi_id')->references('id')->on('program_studis')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kaprodis');
    }
}
