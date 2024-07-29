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
        Schema::create('configuracion_programa_pago', function (Blueprint $table) {
            $table->bigIncrements('cof_id');
            $table->bigInteger('con_id');
            $table->integer('cof_tipo_generar_cuotas');
            $table->integer('cof_tipo_interes');
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
        Schema::dropIfExists('configuracion_programa_pago');
    }
};
