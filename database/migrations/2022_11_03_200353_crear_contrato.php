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
        Schema::create('contrato', function (Blueprint $table) {
            $table->bigIncrements('con_id');
            $table->bigInteger('pro_id');
            $table->text('con_codigo_contrato');
            $table->text('con_nro_contrato');
            $table->double('con_precio_total');
            $table->integer('con_moneda');
            $table->integer('con_tipo_venta');
            $table->double('con_pago_inicial');
            $table->integer('con_plazo');
            $table->double('con_tasa_cambio');
            $table->date('con_fecha_contrato');
            $table->double('con_interes_mora_pago');
            $table->integer('con_meses_mora_pago');
            $table->text('con_descripcion');
            $table->boolean('con_rescindido');
            $table->text('con_causa_rescindido');
            $table->integer('con_tipo');
            $table->bigInteger('con_origen');
            $table->integer('con_anulacion');
            $table->timestamps();
            $table->softDeletes();
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
        Schema::dropIfExists('contrato');
    }
};
