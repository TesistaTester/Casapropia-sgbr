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
        Schema::create('cliente_actividad', function (Blueprint $table) {
            $table->bigIncrements('cla_id');
            $table->bigInteger('cli_id');
            $table->bigInteger('ace_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('cli_id')->references('cli_id')->on('cliente');
            $table->foreign('ace_id')->references('ace_id')->on('actividad_economica');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cliente_actividad');
    }
};
