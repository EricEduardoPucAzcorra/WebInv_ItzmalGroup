<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inv_Recurso_Huesped extends Model
{
    use HasFactory;

    protected $table='inv__recurso__huespeds';

    protected $primaryKey='id_invRHuesped';

    public $with=['recursos_h'];
    
    public $incremeting=true;

    public $timestamps=true;

    public $fillable=[
        'fecha_alta',
        'cantidad_inicial',
        'entrada',
        'salida',
        'total_disponible',
        'descripcion',
        'id_RHuesped'
    ];

        public function recursos_h()
    {
        return $this->belongsTo(Recurso_Huesped::class, 'id_RHuesped', 'id_RHuesped');
    }

}
