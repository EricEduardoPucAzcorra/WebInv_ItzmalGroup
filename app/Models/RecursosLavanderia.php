<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecursosLavanderia extends Model
{
    use HasFactory;

    use HasFactory;
    protected $table='recursos_lavanderias';

    protected $primaryKey='id_RLavado';

    public $with=['AlmacenLav','CategoriaLav'];

    public $incremeting=true;

    public $timestamps=true;

    public $fillable=[
        'nombre',
        'id_AlmacenLavado',
        'id_categoriaPro'
    ];

       public function CategoriaLav()
    {
        return $this->belongsTo(CategoriaProduct::class, 'id_categoriaPro', 'id_categoriaPro');
    }
    

    //   public function CategoriaDep()
    // {
    //     return $this->belongsTo(CategoriaRecursoDepartamental::class, 'id_categoriaDep', 'id_categoriaDep');
    // }

      public function AlmacenLav()
    {
        return $this->belongsTo(AlmacenLavanderia::class, 'id_AlmacenLavado', 'id_AlmacenLavado');
    }
}

