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
        Schema::create('descargo_reserva', function (Blueprint $table) {
            $table->bigIncrements('dre_id');
            $table->bigInteger('cue_id')->nullable();
            $table->bigInteger('res_id');
            $table->date('dre_fecha');
            $table->text('dre_observacion');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('res_id')->references('res_id')->on('reserva');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('descargo_reserva');
    }
};
