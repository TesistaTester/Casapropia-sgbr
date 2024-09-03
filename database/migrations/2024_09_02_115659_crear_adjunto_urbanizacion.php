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
        Schema::create('adjunto_urbanizacion', function (Blueprint $table) {
            $table->bigIncrements('adu_id');
            $table->bigInteger('urb_id');
            $table->text('adu_descripcion');
            $table->text('adu_ruta');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('urb_id')->references('urb_id')->on('urbanizacion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adjunto_urbanizacion');
    }
};
