<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('configuracion_programa_pago', function (Blueprint $table) {
            $table->bigIncrements('cof_id');
            $table->bigInteger('con_id');
            $table->double('cof_precio_total');
            $table->integer('cof_tipo_venta');
            $table->double('cof_interes');
            $table->integer('cof_plazo');
            $table->double('cof_pago_inicial');
            $table->integer('cof_moneda');
            $table->integer('cof_tasa_cambio');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('con_id')->references('con_id')->on('contrato');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configuracion_programa_pago');
    }
};
