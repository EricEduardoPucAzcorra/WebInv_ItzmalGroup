<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria_Recurso_Huesped extends Model
{
    use HasFactory;


    protected $table='categoria__recurso__huespeds';

    protected $primaryKey='id_CatRHuesped';

    public $incremeting=true;

    public $timestamps=true;

    public $fillable=[
    'categoria'
    ];


}
