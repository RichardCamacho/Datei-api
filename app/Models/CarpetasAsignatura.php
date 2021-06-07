<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarpetasAsignatura extends Model
{
    use HasFactory;

    protected $table = 'carpeta_asignatura';//se señala la tabla que va a manejar el modelo si no se usa la conveción

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'codigo',
        'indicador',
        'curriculum',
        'curso',
        'idUsuario'
    ];

    public function usuario()//obtiene el objeto usuario de la carpeta
    {
        return $this->hasOne(User::class, 'id', 'idUsuario');
    }

    public function asignatura()//obtiene el objeto asignatura de la carpeta
    {
        return $this->hasOne(InformacionCurso::class, 'id', 'curso');
    }
}
