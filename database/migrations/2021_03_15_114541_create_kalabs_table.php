<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKalabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kalabs', function (Blueprint $table) {
            $table->foreignUuid('dosen_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignUuid('rmk_id')->references('id')->on('rmks')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kalabs');
    }
}
