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
        Schema::create('solicitud_password', function (Blueprint $table) {
            $table->bigIncrements('spa_id');
            $table->bigInteger('usu_id');
            $table->text('spa_pin');
            $table->text('spa_text');
            $table->timestamp('spa_fecha_solicitud');
            $table->timestamp('spa_fecha_expiracion');
            $table->timestamp('spa_fecha_confirmacion');
            $table->boolean('spa_valido');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('usu_id')->references('usu_id')->on('usuario');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitud_password');
    }
};
