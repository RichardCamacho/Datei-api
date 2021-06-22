<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cursos extends Model
{
    use HasFactory;

    protected $table = 'cursos';//se señala la tabla que va a manejar el modelo si no se usa la conveción

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'codigo',
        'nombreEspaniol',
        'nombreIngles',
        'numeroCreditos',
        'horasSemestre',
        'tipoCurso',
        'informacion'
    ];

    public function tipoCurso()//obtiene el objeto de curso al que pertenece este detalle
    {
        return $this->hasOne(DetalleTipoReferencia::class, 'id', 'tipoCurso');
    }

    public function docentes()
    {
        return $this->hasMany(Docentes::class, 'curso');
    }
    
    public function prerequisitos()
    {
        return $this->hasMany(Prerequisitos::class, 'curso');
    }

    public function objetivos()
    {
        return $this->hasMany(Objetivos::class, 'curso');
    }

    public function temasCurso()
    {
        return $this->hasMany(TemasCurso::class, 'curso');
    }
}
