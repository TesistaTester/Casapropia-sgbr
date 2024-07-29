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
        Schema::create('firma_cliente', function (Blueprint $table) {
            $table->bigIncrements('fic_id');
            $table->bigInteger('con_id');
            $table->bigInteger('cli_id');
            $table->boolean('fic_firmado');
            $table->date('fic_fecha_firmado');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('cli_id')->references('cli_id')->on('cliente');
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
        Schema::dropIfExists('firma_cliente');
    }
};
