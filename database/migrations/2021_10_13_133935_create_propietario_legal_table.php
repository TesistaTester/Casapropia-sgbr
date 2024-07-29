<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropietarioLegalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propietario_legal', function (Blueprint $table) {
            $table->bigIncrements('ple_id');
            $table->bigInteger('per_id');
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
        Schema::dropIfExists('propietario_legal');
    }
}
