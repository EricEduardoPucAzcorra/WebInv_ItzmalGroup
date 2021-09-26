<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MensajeEmail extends Model
{
    use HasFactory;

     protected $table='mensaje_emails';

    protected $primaryKey='id_mensaje';
    
    public $incremeting=true;

    public $timestamps=true;

    public $fillable=[
        'email',
        'asunto',
        'mensaje',
        'archivo',
        
    ];

}
