<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecursosDepartamentales extends Model
{
    use HasFactory;
    protected $table='recursos_departamentales';

    protected $primaryKey='id_recursoDep';

    public $with=['CategoriaDep','AlmacenDep'];

    public $incremeting=true;

    public $timestamps=true;

    public $fillable=[
        'nombre',
        'descripcion',
        'id_categoriaPro',
        'id_almacenDep'
    ];

      public function CategoriaDep()
    {
        return $this->belongsTo(CategoriaProduct::class, 'id_categoriaPro', 'id_categoriaPro');
    }
    
    //   public function CategoriaDep()
    // {
    //     return $this->belongsTo(CategoriaRecursoDepartamental::class, 'id_categoriaDep', 'id_categoriaDep');
    // }

      public function AlmacenDep()
    {
        return $this->belongsTo(AlmacenRecursosDepartamentales::class, 'id_almacenDep', 'id_almacenDep');
    }
}
