<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleTipoReferencia extends Model
{
    use HasFactory;

    protected $table = 'detalles_referencia'; //referenciando la correspondiente tabla

    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = [
        'nombre',
        'tipoReferencia',
    ];

    public function tipoDeReferencia()//obtiene el objeto de tipo de refernecia al que pertenece este detalle
    {
        return $this->belongsTo(TiposReferencia::class, 'tipoReferencia');
    }

    public function prerequisito()//obtiene el objeto de curso al que pertenece este detalle
    {
        return $this->belongsTo(Prerequisitos::class, 'tipo');
    }
}
