<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coautores extends Model
{
    use HasFactory;

    protected $table = 'coautores';//se señala la tabla que va a manejar el modelo si no se usa la conveción

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'publicacion'
    ];

    public function publicacion()//obtiene el objeto publicacion al que pertenece este detalle
    {
        return $this->belongsTo(Publicaciones::class, 'publicacion');
    }
}
