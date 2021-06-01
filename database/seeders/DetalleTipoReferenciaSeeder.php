<?php

namespace Database\Seeders;

use App\Models\DetalleTipoReferencia;
use Illuminate\Database\Seeder;

class DetalleTipoReferenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ///////////////////////////////////////////////////////////////////
        $detalle = new DetalleTipoReferencia();
        $detalle->nombre = 'Docente';
        $detalle->tipoReferencia = 1;
        $detalle->save();
        
        $detalle1 = new DetalleTipoReferencia();
        $detalle1->nombre = 'Coordinador';
        $detalle1->tipoReferencia = 1;
        $detalle1->save();

        $detalle1 = new DetalleTipoReferencia();
        $detalle1->nombre = 'Administrador';
        $detalle1->tipoReferencia = 1;
        $detalle1->save();

        ///////////////////////////////////////////////////////////////////
        $detalle2 = new DetalleTipoReferencia();
        $detalle2->nombre = 'Ingeniería de Sistemas';
        $detalle2->tipoReferencia = 2;
        $detalle2->save();

        $detalle3 = new DetalleTipoReferencia();
        $detalle3->nombre = 'Ingeniería de Alimentos';
        $detalle3->tipoReferencia = 2;
        $detalle3->save();

        $detalle4 = new DetalleTipoReferencia();
        $detalle4->nombre = 'Ingeniería Química';
        $detalle4->tipoReferencia = 2;
        $detalle4->save();

        $detalle5 = new DetalleTipoReferencia();
        $detalle5->nombre = 'Química Farmacéutica';
        $detalle5->tipoReferencia = 2;
        $detalle5->save();

        ///////////////////////////////////////////////////////////////////
        $detalle5 = new DetalleTipoReferencia();
        $detalle5->nombre = 'Profesor Emérito';
        $detalle5->tipoReferencia = 3;
        $detalle5->save();

        $detalle6 = new DetalleTipoReferencia();
        $detalle6->nombre = 'Profesor Titular';
        $detalle6->tipoReferencia = 3;
        $detalle6->save();

        $detalle8 = new DetalleTipoReferencia();
        $detalle8->nombre = 'Profesor Asistente';
        $detalle8->tipoReferencia = 3;
        $detalle8->save();

        $detalle9 = new DetalleTipoReferencia();
        $detalle9->nombre = 'Profesor de Planta';
        $detalle9->tipoReferencia = 3;
        $detalle9->save();

        $detalle10 = new DetalleTipoReferencia();
        $detalle10->nombre = 'Profesor Cátedra';
        $detalle10->tipoReferencia = 3;
        $detalle10->save();

        ///////////////////////////////////////////////////////////////////
        $detalle11 = new DetalleTipoReferencia();
        $detalle11->nombre = 'Tiempo Completo';
        $detalle11->tipoReferencia = 4;
        $detalle11->save();

        $detalle12 = new DetalleTipoReferencia();
        $detalle12->nombre = 'Tiempo Parcial';
        $detalle12->tipoReferencia = 4;
        $detalle12->save();
        
        ///////////////////////////////////////////////////////////////////

        $detalle13 = new DetalleTipoReferencia();
        $detalle13->nombre = 'Obligatorio';
        $detalle13->tipoReferencia = 5;
        $detalle13->save();

        $detalle14 = new DetalleTipoReferencia();
        $detalle14->nombre = 'Electiva';
        $detalle14->tipoReferencia = 5;
        $detalle14->save();

        $detalle15 = new DetalleTipoReferencia();
        $detalle15->nombre = 'Curso Libre';
        $detalle15->tipoReferencia = 5;
        $detalle15->save();
        
        ///////////////////////////////////////////////////////////////////

        $detalle16 = new DetalleTipoReferencia();
        $detalle16->nombre = 'Pre-Requisito';
        $detalle16->tipoReferencia = 6;
        $detalle16->save();

        $detalle17 = new DetalleTipoReferencia();
        $detalle17->nombre = 'Co-Requisito';
        $detalle17->tipoReferencia = 6;
        $detalle17->save();
        
        ///////////////////////////////////////////////////////////////////
        
        $detalle18 = new DetalleTipoReferencia();
        $detalle18->nombre = 'Grupo A';
        $detalle18->tipoReferencia = 7;
        $detalle18->save();

        $detalle19 = new DetalleTipoReferencia();
        $detalle19->nombre = 'Grupo B';
        $detalle19->tipoReferencia = 7;
        $detalle19->save();

        $detalle20 = new DetalleTipoReferencia();
        $detalle20->nombre = 'Grupo C';
        $detalle20->tipoReferencia = 7;
        $detalle20->save();

    }
}
