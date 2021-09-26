<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlmacenRecursosDepartamentales extends Model
{
    use HasFactory;

    protected $table='almacen_recursos_departamentales';

    protected $primaryKey='id_almacenDep';

    public $incremeting=true;

    public $timestamps=true;

    public $fillable=[
        'nombre',
        'ubicacion'
    ];

}
