<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActasSo extends Model
{
    use HasFactory;

    protected $table = 'actas_so';//se señala la tabla que va a manejar el modelo si no se usa la conveción

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'fechaReunion',
        'lugarReunion',
        'horaInicio',
        'horaFinalizacion',
        'convocadoPor',
        'departamento',
        'objetivo',
        'agenda',
        'acciones',
        'fechaProxReunion',
        'lugarProxReunion',
        'horaProxReunion',
        'carpeta'
    ];
}
