<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Secciones extends Model
{
    use HasFactory;

    protected $table = 'secciones';//se señala la tabla que va a manejar el modelo si no se usa la conveción

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'idCarpeta',
    ];

    public function carpeta()//obtiene el objeto de curso al que pertenece este detalle
    {
        return $this->hasOne(CarpetasAsignatura::class, 'id', 'idCarpeta');
    }
}
