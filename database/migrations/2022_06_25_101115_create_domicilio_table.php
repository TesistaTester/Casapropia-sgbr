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
        Schema::create('domicilio', function (Blueprint $table) {
            $table->bigIncrements('dom_id');
            $table->bigInteger('per_id');
            $table->bigInteger('mun_id')->nullable();
            $table->integer('dom_tipo');
            $table->text('dom_zona');
            $table->text('dom_calle_avenida');
            $table->text('dom_nro');
            $table->text('dom_latitud')->default(0);
            $table->text('dom_longitud')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('per_id')->references('per_id')->on('persona');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('domicilio');
    }
};
