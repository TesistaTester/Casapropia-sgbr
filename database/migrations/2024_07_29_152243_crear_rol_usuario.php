<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rol_usuario', function (Blueprint $table) {
            $table->bigIncrements('rus_id');
            $table->bigInteger('rol_id');
            $table->bigInteger('usu_id');
            $table->text('rus_descripcion');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('rol_id')->references('rol_id')->on('rol');
            $table->foreign('usu_id')->references('usu_id')->on('usuario');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rol_usuario');
    }
};
