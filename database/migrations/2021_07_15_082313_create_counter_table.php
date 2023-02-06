<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCounterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counter', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('alamat', 150)->nullable();
            $table->string('telphone', 15)->nullable();
            $table->string('email')->nullable();
            $table->string('npwp', 50)->nullable();
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
        Schema::dropIfExists('counter');
    }
}
