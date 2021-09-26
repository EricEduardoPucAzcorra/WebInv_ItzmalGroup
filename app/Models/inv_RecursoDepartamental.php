<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inv_RecursoDepartamental extends Model
{
    use HasFactory;

    protected $table='inv__recurso_departamentals';

    protected $primaryKey='id_inventarioDep';

    public $with=['RecursosDep'];
    
    public $incremeting=true;

    public $timestamps=true;

    public $fillable=[
        'fecha_alta',
        'cantidad_inicial',
        'entrada',
        'salida',
        'total_disponible',
        'descripcion',
        'id_recursoDep'
    ];

        public function RecursosDep()
    {
        return $this->belongsTo(RecursosDepartamentales::class, 'id_recursoDep', 'id_recursoDep');
    }

}
