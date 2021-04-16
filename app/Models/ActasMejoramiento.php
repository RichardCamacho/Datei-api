<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActasMejoramiento extends Model
{
    use HasFactory;

    protected $table = 'actas_mejoramiento';//se señala la tabla que va a manejar el modelo si no se usa la conveción

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'accionesPropuestas',
        'accionesControl',
        'otrasAcciones',
        'accionId',
        'motivacion',
        'objetivoEstr',
        'responsable',
        'resultadoEvaluacion',
        'carpeta'
    ];
}
