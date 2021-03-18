<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCplsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cpls', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->longText('name');
            $table->integer('no');
            $table->foreignUuid('jurusan_id')->references('id')->on('jurusans')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cpls');
    }
}
