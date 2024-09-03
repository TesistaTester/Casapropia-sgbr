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
        Schema::create('recibo_pago', function (Blueprint $table) {
            $table->bigIncrements('rep_id');
            $table->bigInteger('ppa_id');
            $table->integer('rep_nro');
            $table->integer('rep_saldo_anterior');
            $table->integer('rep_pago_programado');
            $table->integer('rep_fecha_pago');
            $table->integer('rep_monto_pago');
            $table->integer('rep_tasa_cambio');
            $table->integer('rep_saldo');
            $table->integer('rep_efectivo');
            $table->integer('rep_respaldo');
            $table->integer('rep_observacion');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('ppa_id')->references('ppa_id')->on('programa_pago');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recibo_pago');
    }
};
