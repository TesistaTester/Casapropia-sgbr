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
        Schema::create('cliente_contacto', function (Blueprint $table) {
            $table->bigIncrements('cco_id');
            $table->bigInteger('cli_id');
            $table->bigInteger('foc_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('cli_id')->references('cli_id')->on('cliente');
            $table->foreign('foc_id')->references('foc_id')->on('forma_contacto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cliente_contacto');
    }
};
