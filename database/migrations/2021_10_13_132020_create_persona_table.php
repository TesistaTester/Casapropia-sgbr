<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona', function (Blueprint $table) {
            $table->bigIncrements('per_id');
            $table->bigInteger('pai_id');
            $table->integer('per_tipo_persona');
            $table->integer('per_tipo_documento');
            $table->text('per_nro_id');
            $table->text('per_expedido');
            $table->text('per_nombres');
            $table->text('per_primer_apellido');
            $table->text('per_segundo_apellido');
            $table->text('per_estado_civil');
            $table->date('per_fecha_nacimiento');
            $table->text('per_sexo');
            $table->text('per_nombre_comercial');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('pai_id')->references('pai_id')->on('pais');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('persona');
    }
}
