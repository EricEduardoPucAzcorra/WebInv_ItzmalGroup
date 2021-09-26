<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvLavanderia extends Model
{
    use HasFactory;

    protected $table='inv_lavanderias';

    protected $primaryKey='id_invLavado';

    public $with=['recursosLav'];
    
    public $incremeting=true;

    public $timestamps=true;

    public $fillable=[
        'fecha_alta',
        'cantidad_inicial',
        'entrada',
        'salida',
        'cat_disponible',
        'descripcion',
        'id_RLavado'
    ];

        public function recursosLav()
    {
        return $this->belongsTo(RecursosLavanderia::class, 'id_RLavado', 'id_RLavado');
    }

}
