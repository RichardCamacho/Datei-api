<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarpetasSo extends Model
{
    use HasFactory;

    protected $table = 'carpeta_so';//se señala la tabla que va a manejar el modelo si no se usa la conveción

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'codigo',
        'indicador',
        'idUsuario'
    ];

    public function usuario()//obtiene el objeto de usuario 
    {
        return $this->hasOne(User::class, 'id', 'idUsuario');
    }
}
