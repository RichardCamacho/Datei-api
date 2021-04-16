<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TiposReferencia;

class TiposReferenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipo = new TiposReferencia();
        $tipo->nombre = 'Roles';
        $tipo->descripcion = 'Roles para categorizar los usuarios en el sistema';
        $tipo->save();

        $tipo1 = new TiposReferencia();
        $tipo1->nombre = 'Programas';
        $tipo1->descripcion = 'Programas académicos de la Universidad de Cartagena';
        $tipo1->save();

        $tipo2 = new TiposReferencia();
        $tipo2->nombre = 'Rangos';
        $tipo2->descripcion = 'Diferentes estatus que tienen los docentes de la Universidad de Cartagena';
        $tipo2->save();

        $tipo3 = new TiposReferencia();
        $tipo3->nombre = 'Tiempos';
        $tipo3->descripcion = 'Describe la disponibilidad del docente en el recinto académico';
        $tipo3->save();

        $tipo4 = new TiposReferencia();
        $tipo4->nombre = 'Tipo de Curso';
        $tipo4->descripcion = 'Describe los tipos de curso que puede ver el estudiante';
        $tipo4->save();
        
        $tipo4 = new TiposReferencia();
        $tipo4->nombre = 'Requisitos';
        $tipo4->descripcion = 'Describe la dependencia de los cursos';
        $tipo4->save();

        $tipo6 = new TiposReferencia();
        $tipo6->nombre = 'Grupos';
        $tipo6->descripcion = 'Diferentes grupos en una asignatura';
        $tipo6->save();
    }
}
