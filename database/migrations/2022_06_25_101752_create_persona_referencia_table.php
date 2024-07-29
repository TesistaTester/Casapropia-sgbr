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
        Schema::create('persona_referencia', function (Blueprint $table) {
            $table->bigIncrements('pre_id');
            $table->bigInteger('per_id');
            $table->bigInteger('cli_id');
            $table->text('pre_parentesco');
            $table->text('pre_telefono');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('per_id')->references('per_id')->on('persona');
            $table->foreign('cli_id')->references('cli_id')->on('cliente');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('persona_referencia');
    }
};
