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
        Schema::create('cliente', function (Blueprint $table) {
            $table->bigIncrements('cli_id');
            $table->bigInteger('per_id');
            $table->text('cli_telefono');
            $table->text('cli_email');
            $table->text('cli_foto')->default('foto_default_cliente.jpg');
            $table->text('cli_copia_ci')->default('sin_adjuntar');
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
        Schema::dropIfExists('cliente');
    }
};
