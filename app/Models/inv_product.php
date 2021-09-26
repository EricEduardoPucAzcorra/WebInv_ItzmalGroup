<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inv_product extends Model
{
    protected $table='inv_products';

    protected $primaryKey='id_inventarioPro';

    public $with=['productos'];
    
    public $incremeting=true;

    public $timestamps=true;

    public $fillable=[
        'fecha_alta',
        'cantidad_inicial',
        'entrada',
        'salida',
        'venta',
        'total',
        'descripcion',
        'id_producto'
    ];

        public function productos()
    {
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }
}
