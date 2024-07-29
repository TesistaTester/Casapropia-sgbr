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
        Schema::create('asignacion_propietario_legal', function (Blueprint $table) {
            $table->bigIncrements('apl_id');
            $table->bigInteger('ple_id');
            $table->bigInteger('pro_id');
            $table->text('apl_descripcion');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('ple_id')->references('ple_id')->on('propietario_legal');
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
        Schema::dropIfExists('asignacion_propietario_legal');
    }
};
