<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModalidadVentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modalidad_venta', function (Blueprint $table) {
            $table->bigIncrements('mov_id');
            $table->bigInteger('pro_id');
            $table->integer('mov_tipo_venta');
            $table->integer('mov_moneda_venta');
            $table->float('mov_monto_interes', 10, 2);
            $table->float('mov_tasa_interes', 10, 2);
            $table->float('mov_precio_oferta', 10, 2);
            $table->float('mov_precio_minimo', 10, 2);
            $table->float('mov_cuota_inicial', 10, 2);
            $table->integer('mov_plazo');
            $table->float('mov_precio_total_minimo', 10, 2);
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
        Schema::dropIfExists('modalidad_venta');
    }
}
