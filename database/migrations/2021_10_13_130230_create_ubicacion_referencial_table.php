<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUbicacionReferencialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ubicacion_referencial', function (Blueprint $table) {
            $table->bigIncrements('ure_id');
            $table->bigInteger('ubi_id');
            $table->bigInteger('lot_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('ubi_id')->references('ubi_id')->on('ubicacion');
            $table->foreign('lot_id')->references('lot_id')->on('lote');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ubicacion_referencial');
    }
}
