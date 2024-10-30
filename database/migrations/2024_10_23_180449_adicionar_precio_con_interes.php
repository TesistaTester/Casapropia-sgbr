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
        Schema::table('contrato', function (Blueprint $table) {
            $table->double('con_precio_interes')->nullable();
            $table->date('con_fecha_limite')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contrato', function (Blueprint $table) {
            $table->dropColumn('con_precio_interes');
            $table->dropColumn('con_fecha_limite');
        });
    }
};
