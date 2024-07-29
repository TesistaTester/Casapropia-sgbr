<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUrbanizacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('urbanizacion', function (Blueprint $table) {
            $table->bigIncrements('urb_id');
            $table->bigInteger('ter_id')->nullable();
            $table->text('urb_nombre');
            $table->date('urb_fecha_aprobacion')->nullable();
            $table->text('urb_ley')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('urbanizacion');
    }
}
