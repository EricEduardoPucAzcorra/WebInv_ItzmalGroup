<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class almacenProduct extends Model
{
    use HasFactory;

    protected $table='almacen_products';

    protected $primaryKey='id_almacenPro';

    public $incremeting=true;

    public $timestamps=true;

    public $fillable=[
        'nombre',
        'ubicacion'
    ];
}
