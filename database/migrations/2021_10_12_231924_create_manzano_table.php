<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManzanoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manzano', function (Blueprint $table) {
            $table->bigIncrements('man_id');
            $table->bigInteger('urb_id');
            $table->text('man_nombre');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('urb_id')->references('urb_id')->on('urbanizacion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manzano');
    }
}
