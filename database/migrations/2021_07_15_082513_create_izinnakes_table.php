<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIzinnakesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('izinnakes', function (Blueprint $table) {
            $table->id();
            $table->string('nomor', 50);
            $table->foreignId('employee_id');
            $table->foreignId('department_id');
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
        Schema::dropIfExists('izinnakes');
    }
}
