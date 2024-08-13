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
        Schema::create('usuario', function (Blueprint $table) {
            $table->bigIncrements('usu_id');
            $table->bigInteger('per_id')->nullable();
            $table->text('usu_email');
            $table->text('password');
            $table->boolean('usu_primer_login')->nullable();
            $table->timestamp('usu_expiracion_passsword')->nullable();
            $table->boolean('usu_activo')->nullable();
            $table->text('usu_foto')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('per_id')->references('per_id')->on('persona');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario');
    }
};
