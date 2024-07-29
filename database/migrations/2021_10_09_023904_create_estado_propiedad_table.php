<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadoPropiedadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estado_propiedad', function (Blueprint $table) {
            $table->bigIncrements('esp_id');
            $table->bigInteger('edi_id');
            $table->bigInteger('pro_id');
            $table->date('esp_fecha');
            $table->text('esp_descripcion');
            $table->integer('esp_activo');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('edi_id')->references('edi_id')->on('estado_disponibilidad');
            $table->foreign('pro_id')->references('pro_id')->on('propiedad');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estado_propiedad');
    }
}
