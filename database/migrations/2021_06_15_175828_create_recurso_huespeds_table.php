<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecursoHuespedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recurso_huespeds', function (Blueprint $table) {
            $table->increments('id_RHuesped');
            
            $table->string('nombre');
            //relaciones 
            
            $table->integer('id_AlmacenRHuesped');

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
        Schema::dropIfExists('recurso_huespeds');
    }
}
