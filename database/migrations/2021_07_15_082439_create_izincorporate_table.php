<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIzincorporateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('izincorporate', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nomor', 50);
            $table->foreignId('penerbit_id');
            $table->date('tglterbit');
            $table->date('tglexp');
            $table->string('picture_path')->nullable();
            $table->string('file_path')->nullable();
            $table->foreignId('unit_id');
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
        Schema::dropIfExists('izincorporate');
    }
}
