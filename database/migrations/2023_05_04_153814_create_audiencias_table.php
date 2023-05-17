<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAudienciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audiencias', function (Blueprint $table) {

            $table->increments('id');
            $table->string("title", 255);
            $table->dateTime("start");
            $table->dateTime("end");
            $table->string("tipoAudiencia", 255);
            $table->string("sala", 255);
            $table->string("magis", 255);
            $table->string("abo_patrocinante", 255)->nullable();
            $table->string("textColor", 7);
            $table->string("backgroundColor", 7);
            $table->string("observaciones", 255)->nullable();

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
        Schema::dropIfExists('audiencias');
    }
}
