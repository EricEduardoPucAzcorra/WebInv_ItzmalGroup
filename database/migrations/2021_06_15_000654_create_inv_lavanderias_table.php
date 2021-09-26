<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvLavanderiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inv_lavanderias', function (Blueprint $table) {
            $table->increments('id_invLavado');
            $table->date('fecha_alta');
            $table->float('cantidad_inicial');
            $table->float('entrada');
            $table->float('salida');
            $table->float('cat_disponible');
            $table->string('descripcion');
            $table->integer('id_RLavado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inv_lavanderias');
    }
}
