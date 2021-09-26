<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlmacenLavanderia extends Model
{
    use HasFactory;

    protected $table='almacen_lavanderias';

    protected $primaryKey='id_AlmacenLavado';

    public $incremeting=true;

    public $timestamps=true;

    public $fillable=[
        'nombre',
        'ubicacion'
    ];
}
