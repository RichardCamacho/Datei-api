<?php

namespace App\Http\Controllers;

use App\Models\DetalleTipoReferencia;
use App\Models\ExperienciaAcademica;
use Illuminate\Http\Request;

class ExperienciaAcademicaController extends Controller
{
    public function index()
    {
        return ExperienciaAcademica::all();
    }

    //registro de experiencia academica
    public function register(Request $request)
    {
        $expAcademica = ExperienciaAcademica::create([
            'fechaFinalizacion' => $request->fechaFinalizacion,
            'fechaInicio' => $request->fechaInicio,
            'institucion' => $request->institucion,
            'rango' => $request->rango["id"],
            'tiempo' => $request->tiempo["id"],
            'titulo' => $request->titulo,
            'hoja_vida' => $request->hoja_vida
        ]);

        return response()->json($expAcademica, 201);
    }

    //consulta de todos los registros de experiencia academica, ordenados por fecha de terminacion
    public function listAcademicExp()
    {
        $expAcademica = ExperienciaAcademica::orderBy('fechaFinalizacion', 'asc')
                                        ->get();
        return response()->json($expAcademica, 200);
    }

    //consulta de todos los registros de experiencia academica, por id de hoja de vida, ordenados por fecha de terminacion
    public function listAcademicExpByHv($idHv)
    {
        $expAcademica = ExperienciaAcademica::where("hoja_vida","=",$idHv)
                                        ->orderBy('fechaFinalizacion', 'asc')
                                        ->get();

        return response()->json($expAcademica, 200);
    }

    //consultar un registro de experiencia academica por id
    public function getAcademicExpById($id)
    {
        $expAcademica = ExperienciaAcademica::find($id);
        if (is_null($expAcademica)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        
        $detalleRango = DetalleTipoReferencia::where("id","=",$expAcademica->rango)
                                            ->first();
        $detalleTiempo = DetalleTipoReferencia::where("id","=",$expAcademica->tiempo)
                                                ->first();

        $expAcademica->rango = $detalleRango;
        $expAcademica->tiempo = $detalleTiempo;

        return response()->json($expAcademica, 200);
    }

    //actualizar informacion de un registro de experiencia academica
    public function updateAcademicExp(Request $request, $id)
    {
        //se verifica si el registro existe
        $expAcademica = ExperienciaAcademica::find($id);
        if (is_null($expAcademica)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }

        $expAcademica->fechaFinalizacion = $request->fechaFinalizacion;
        $expAcademica->fechaInicio = $request->fechaInicio;
        $expAcademica->institucion = $request->institucion;
        $expAcademica->rango = $request->rango["id"];
        $expAcademica->tiempo = $request->tiempo["id"];
        $expAcademica->titulo = $request->titulo;
        $result = $expAcademica->save();

        if ($result) {
            return response()->json($expAcademica, 201);
        } else {
            return response()->json(['message' => 'Registro no actualizado'], 400);
        }
    }

    //eliminar un registro de experiencia academica
    public function deleteAcademicExp($id)
    {
        //se verifica si el registro existe
        $expAcademica = ExperienciaAcademica::find($id);
        if (is_null($expAcademica)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        $expAcademica->delete();
        return response()->json(['message' => 'Registro eliminado'], 200);
    }
}
