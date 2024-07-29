<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reconocimiento_firmas', function (Blueprint $table) {
            $table->bigIncrements('rfi_id');
            $table->bigInteger('con_id');
            $table->text('rfi_nro_tramite');
            $table->text('rfi_concepto');
            $table->bigInteger('rfi_ciudad');
            $table->date('rfi_fecha');
            $table->text('rfi_nro_notaria');
            $table->bigInteger('rfi_depto_notaria');
            $table->text('rfi_nombre_notaria');
            $table->text('rfi_ruta_digital');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('con_id')->references('con_id')->on('contrato');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reconocimiento_firmas');
    }
};
