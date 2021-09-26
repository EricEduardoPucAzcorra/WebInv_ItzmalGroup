<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inv_products', function (Blueprint $table) {
            $table->increments('id_inventarioPro');

            $table->date('fecha_alta');

            $table->integer('cantidad_inicial');

            $table->integer('entrada');

            $table->integer('salida');

            $table->integer('venta');

            $table->integer('total');

            $table->string('descripcion',150);

            //claves foreanes

            $table->integer('id_producto');

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
        Schema::dropIfExists('inv_products');
    }
}
