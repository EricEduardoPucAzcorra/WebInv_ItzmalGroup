<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table='productos';

    protected $primaryKey='id_producto';

    public $with=['Categoria','Almacen'];

    public $incremeting=true;

    public $timestamps=true;

    public $fillable=[
        'nombre',
        'precio',
        'descripcion',
        'id_categoriaPro',
        'id_almacenPro'
    ];

      public function Categoria()
    {
        return $this->belongsTo(CategoriaProduct::class, 'id_categoriaPro', 'id_categoriaPro');
    }

      public function Almacen()
    {
        return $this->belongsTo(AlmacenProduct::class, 'id_almacenPro', 'id_almacenPro');
    }


}
