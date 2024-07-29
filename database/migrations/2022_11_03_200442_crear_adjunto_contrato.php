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
        Schema::create('adjunto_contrato', function (Blueprint $table) {
            $table->bigIncrements('aco_id');
            $table->bigInteger('con_id');
            $table->text('aco_descripcion');
            $table->text('aco_ruta');
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
        Schema::dropIfExists('adjunto_contrato');
    }
};
