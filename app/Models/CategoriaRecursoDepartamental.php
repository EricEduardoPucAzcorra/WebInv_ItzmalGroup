<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaRecursoDepartamental extends Model
{
    use HasFactory;

    protected $table='categoria_recurso_departamentals';

    protected $primaryKey='id_categoriaDep';

    public $incremeting=true;

    public $timestamps=true;

    public $fillable=[
    'categoria'
    ];


}
