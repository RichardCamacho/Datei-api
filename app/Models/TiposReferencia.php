<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiposReferencia extends Model
{
    use HasFactory;

    protected $table = 'tipos_referencia'; //referenciando la correspondiente tabla

    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function detallesTipoReferencia()
    {
        return $this->hasMany(DetalleTipoReferencia::class, 'tipoReferencia')->orderBy('nombre');
    }
}
