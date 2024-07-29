<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropiedadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propiedad', function (Blueprint $table) {
            $table->bigIncrements('pro_id');
            $table->float('pro_superficie',10, 2)->nullable()->default(0);
            $table->float('pro_muro_perimetral', 20, 2)->nullable()->default(0);
            $table->text('pro_descripcion')->nullable();
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
        Schema::dropIfExists('propiedad');
    }
}
