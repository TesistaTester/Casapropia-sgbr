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
        Schema::create('recibo_reconocimiento_firmas', function (Blueprint $table) {
            $table->bigIncrements('ref_id');
            $table->bigInteger('rfi_id');
            $table->integer('ref_nro');
            $table->date('ref_fecha_pago');
            $table->double('ref_monto_pago');
            $table->double('ref_tasa_cambio');
            $table->integer('ref_efectivo');
            $table->text('ref_respaldo');
            $table->text('ref_observacion');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('rfi_id')->references('rfi_id')->on('reconocimiento_firmas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recibo_reconocimiento_firmas');
    }
};
