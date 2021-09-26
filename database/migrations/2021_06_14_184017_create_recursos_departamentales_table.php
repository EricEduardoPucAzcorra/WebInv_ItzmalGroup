<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecursosDepartamentalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recursos_departamentales', function (Blueprint $table) {
            $table->increments('id_recursoDep');
            $table->string('nombre',50);
            $table->string('descripcion',150);
            $table->integer('id_categoriaPro');
            $table->integer('id_almacenDep');         
            //s$statu->string('statu')->nullable();
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
        Schema::dropIfExists('recursos_departamentales');
    }
}
