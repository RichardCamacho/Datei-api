<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objetivos extends Model
{
    use HasFactory;

    protected $table = 'objetivos_especificos';//se señala la tabla que va a manejar el modelo si no se usa la conveción

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'curso',
    ];

    public function curso()//obtiene el objeto de curso al que pertenece este detalle
    {
        return $this->belongsTo(InformacionCurso::class, 'curso');
    }
}
