<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recurso_huesped extends Model
{
    use HasFactory;
       protected $table='recurso_huespeds';

    protected $primaryKey='id_RHuesped';

    public $with=['categoriaRH','AlmacenRH'];

    public $incremeting=true;

    public $timestamps=true;

    public $fillable=[
        'nombre',
        'id_AlmacenRHuesped',
        'id_categoriaPro'
    ];

    //relations

      public function categoriaRH()
    {
        return $this->belongsTo(CategoriaProduct::class, 'id_categoriaPro', 'id_categoriaPro');
    }


    //   public function categoriaRH()
    // {
    //     return $this->belongsTo(Categoria_Recurso_Huesped::class, 'id_CatRHuesped', 'id_CatRHuesped');
    // }

      public function AlmacenRH()
    {
        return $this->belongsTo(Almacen_Recurso_Huesped::class, 'id_AlmacenRHuesped', 'id_AlmacenRHuesped');
    }
}
