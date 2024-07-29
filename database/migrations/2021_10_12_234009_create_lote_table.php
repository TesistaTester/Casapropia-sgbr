<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lote', function (Blueprint $table) {
            $table->bigIncrements('lot_id');
            $table->bigInteger('pro_id');
            $table->bigInteger('man_id');
            $table->integer('lot_nro');
            $table->text('lot_codigo')->nullable();
            $table->text('lot_matricula')->nullable();
            $table->float('lot_ancho_via', 10, 2)->nullable()->default(0);
            $table->float('lot_superficie_construida', 10, 2)->nullable()->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('pro_id')->references('pro_id')->on('propiedad');
            $table->foreign('man_id')->references('man_id')->on('manzano');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lote');
    }
}
