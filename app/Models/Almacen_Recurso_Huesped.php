<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Almacen_Recurso_Huesped extends Model
{
    use HasFactory;

     protected $table='almacen__recurso__huespeds';

    protected $primaryKey='id_AlmacenRHuesped';

    public $incremeting=true;

    public $timestamps=true;

    public $fillable=[
        'nombre',
        'ubicacion'
    ];
}
