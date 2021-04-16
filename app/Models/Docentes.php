<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docentes extends Model
{
    use HasFactory;

    protected $table = 'docentes';//se señala la tabla que va a manejar el modelo si no se usa la conveción

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'grupo',
        'curso',
        'infCurso'
    ];

    public function grupo()//obtiene el objeto de curso al que pertenece este detalle
    {
        return $this->hasOne(DetalleTipoReferencia::class, 'id', 'grupo');
    }

    public function curso()//obtiene el objeto de tipo de refernecia al que pertenece este detalle
    {
        return $this->belongsTo(cursos::class, 'curso');
    }
}
