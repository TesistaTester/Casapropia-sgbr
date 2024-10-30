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
        Schema::create('programa_pago', function (Blueprint $table) {
            $table->bigIncrements('ppa_id');
            $table->bigInteger('cof_id');
            $table->text('ppa_nro');
            $table->date('ppa_fecha_programada');
            $table->double('ppa_cuota_programada');
            $table->double('ppa_cuota_cambio');
            $table->double('ppa_interes_mensual');
            $table->double('ppa_amortizacion_mensual');
            $table->double('ppa_saldo');
            $table->boolean('ppa_completado')->nullable();
            $table->date('ppa_fecha_vencimiento')->nullable();
            $table->boolean('ppa_vencido')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('cof_id')->references('cof_id')->on('configuracion_programa_pago');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programa_pago');
    }
};
