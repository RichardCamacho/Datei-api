<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libros extends Model
{
    use HasFactory;

    protected $table = 'libros';//se señala la tabla que va a manejar el modelo si no se usa la conveción

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titulo',
        'editorial',
        'autor',
        'anio',
        'curso',
    ];

    public function curso()//obtiene el objeto de curso al que pertenece este detalle
    {
        return $this->belongsTo(InformacionCurso::class, 'curso');
    }
}