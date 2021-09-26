<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecursosLavanderiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recursos_lavanderias', function (Blueprint $table) {
            $table->increments('id_RLavado');
            $table->string('nombre');
            //clave foremea
            $table->integer('id_AlmacenLavado');

            $table->integer('id_categoriaPro');

            
            //$statu->string('statu')->nullable();
            
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
        Schema::dropIfExists('recursos_lavanderias');
    }
}
