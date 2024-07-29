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
        Schema::create('reserva', function (Blueprint $table) {
            $table->bigIncrements('res_id');
            $table->bigInteger('pro_id');
            $table->bigInteger('per_id');
            $table->integer('res_nro_recibo');
            $table->text('res_concepto_recibo')->nullable();
            $table->integer('res_moneda')->nullable();
            $table->double('res_monto')->nullable();
            $table->integer('res_efectivo')->nullable();
            $table->date('res_fecha_recibo')->nullable();
            $table->text('res_observacion_pago')->nullable();
            $table->text('res_modalidad')->nullable();
            $table->boolean('res_ampliacion_exp')->nullable();
            $table->date('res_fecha_expiracion')->nullable();
            $table->boolean('res_devuelto')->nullable();
            $table->date('res_fecha_devolucion')->nullable();
            $table->text('res_observacion_devolucion')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('pro_id')->references('pro_id')->on('propiedad');
            $table->foreign('per_id')->references('per_id')->on('persona');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reserva');
    }
};
