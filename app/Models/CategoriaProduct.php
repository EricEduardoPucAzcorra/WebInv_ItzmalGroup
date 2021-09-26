<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaProduct extends Model
{
    use HasFactory;


    protected $table='categoria_products';

    protected $primaryKey='id_categoriaPro';

    public $incremeting=true;

    public $timestamps=true;

    public $fillable=[
    'categoria'
    ];

}
