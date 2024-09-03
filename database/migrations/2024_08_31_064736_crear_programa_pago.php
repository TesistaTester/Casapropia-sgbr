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
            $table->date('ppa_fecha_programada');
            $table->double('ppa_cuota_programada');
            $table->boolean('ppa_completado');
            $table->date('ppa_fecha_vencimiento');
            $table->boolean('ppa_vencido');
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
