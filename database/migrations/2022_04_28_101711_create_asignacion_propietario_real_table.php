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
        Schema::create('asignacion_propietario_real', function (Blueprint $table) {
            $table->bigIncrements('apr_id');
            $table->bigInteger('prr_id');
            $table->bigInteger('pro_id');
            $table->float('apr_participacion', 5, 2);
            $table->text('apr_descripcion');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('prr_id')->references('prr_id')->on('propietario_real');
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
        Schema::dropIfExists('asignacion_propietario_real');
    }
};
