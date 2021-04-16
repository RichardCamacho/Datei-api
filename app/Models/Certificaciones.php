<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificaciones extends Model
{
    use HasFactory;

    protected $table = 'certificaciones';//se señala la tabla que va a manejar el modelo si no se usa la conveción

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'numeroCertificacion',
        'hoja_vida',
    ];

    public function hojaVida()//obtiene el objeto de hoja de vida al que pertenece este detalle
    {
        return $this->belongsTo(HojasVida::class, 'hoja_vida');
    }
}
