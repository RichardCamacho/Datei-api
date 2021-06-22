<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformacionCurso extends Model
{
    use HasFactory;

    protected $table = 'informacion_curso';//se señala la tabla que va a manejar el modelo si no se usa la conveción

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
        'informacion',
        'titulo',
        'editorial',
        'autor',
        'anio',
        'filename',
        'idUsuario',
        'idCurso'
    ];

    public function tipoCurso()
    {
        return $this->hasOne(DetalleTipoReferencia::class, 'id', 'tipoCurso');
    }
    
    public function profesor()
    {
        return $this->hasOne(User::class, 'id', 'idUsuario');
    }

    public function libros()
    {
        return $this->hasMany(Libros::class, 'curso');
    }

    public function studentOutcomes()
    {
        return $this->hasMany(StudentOutcomes::class, 'curso');
    }
}
