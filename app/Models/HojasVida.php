<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HojasVida extends Model
{
    use HasFactory;

    protected $table = 'hojas_vida';//se señala la tabla que va a manejar el modelo si no se usa la conveción

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'primerNombre',
        'segundoNombre',
        'primerApellido',
        'segundoApellido',
        'rango',
        'rol',
        'programa',
        'idUsuario',
    ];

    public function estudios()
    {
        return $this->hasMany(Estudios::class, 'hoja_vida');
    }

    public function expAcademica()
    {
        return $this->hasMany(ExperienciaAcademica::class, 'hoja_vida');
    }

    public function expNoAcademica()
    {
        return $this->hasMany(ExperienciaNoAcademica::class, 'hoja_vida');
    }

    public function certificaciones()
    {
        return $this->hasMany(Certificaciones::class, 'hoja_vida');
    }

    public function organizaciones()
    {
        return $this->hasMany(Organizaciones::class, 'hoja_vida');
    }

    public function premios()
    {
        return $this->hasMany(Premios::class, 'hoja_vida');
    }

    public function activServicio()
    {
        return $this->hasMany(ActividadServicio::class, 'hoja_vida');
    }

    public function publicaciones()
    {
        return $this->hasMany(Publicaciones::class, 'hoja_vida');
    }

    public function activProfesional()
    {
        return $this->hasMany(ActividadProfesional::class, 'hoja_vida');
    }
}
