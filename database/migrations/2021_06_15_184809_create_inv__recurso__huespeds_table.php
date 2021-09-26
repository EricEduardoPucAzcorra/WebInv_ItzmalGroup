<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvRecursoHuespedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inv__recurso__huespeds', function (Blueprint $table) {
            $table->increments('id_invRHuesped');
            $table->date('fecha_alta');
            $table->integer('cantidad_inicial');
            $table->integer('entrada');
            $table->integer('salida');
            $table->integer('venta');
            $table->integer('total_disponible');
             $table->string('descripcion');
             //relaciones 
             $table->integer('id_RHuesped');
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
        Schema::dropIfExists('inv__recurso__huespeds');
    }
}
