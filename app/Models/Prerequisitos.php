<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prerequisitos extends Model
{
    use HasFactory;

    protected $table = 'prerequisitos';//se señala la tabla que va a manejar el modelo si no se usa la conveción

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'tipo',
        'curso',
    ];

    public function curso()//obtiene el objeto de curso al que pertenece este detalle
    {
        return $this->belongsTo(InformacionCurso::class, 'curso');
    }

    public function tipo()//obtiene el objeto de curso al que pertenece este detalle
    {
        return $this->hasOne(DetalleTipoReferencia::class, 'id', 'tipo');
    }
}
