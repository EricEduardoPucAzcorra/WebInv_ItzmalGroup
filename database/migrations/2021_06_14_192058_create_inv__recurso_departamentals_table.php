<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvRecursoDepartamentalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inv__recurso_departamentals', function (Blueprint $table) {
            
            $table->increments('id_inventarioDep');

            $table->date('fecha_alta');

            $table->integer('cantidad_inicial');

            $table->integer('entrada');

            $table->integer('salida');

            $table->integer('total_disponible');

            $table->string('descripcion',150);

            //claves foreanes

            $table->integer('id_recursoDep');


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
        Schema::dropIfExists('inv__recurso_departamentals');
    }
}
