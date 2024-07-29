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
        Schema::create('firma_propietario_legal', function (Blueprint $table) {
            $table->bigIncrements('fip_id');
            $table->bigInteger('con_id');
            $table->bigInteger('ple_id');
            $table->boolean('fip_firmado');
            $table->date('fip_fecha_firmado');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('ple_id')->references('ple_id')->on('propietario_legal');
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
        Schema::dropIfExists('firma_propietario_legal');
    }
};
