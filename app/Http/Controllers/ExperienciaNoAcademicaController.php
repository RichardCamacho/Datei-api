<?php

namespace App\Http\Controllers;

use App\Models\DetalleTipoReferencia;
use App\Models\ExperienciaNoAcademica;
use Illuminate\Http\Request;

class ExperienciaNoAcademicaController extends Controller
{
    public function index()
    {
        return ExperienciaNoAcademica::all();
    }

    //registro de experiencia no academica
    public function register(Request $request)
    {
        $expNoAcademica = ExperienciaNoAcademica::create([
            'fechaFinalizacion' => $request->fechaFinalizacion,
            'fechaInicio' => $request->fechaInicio,
            'compania' => $request->compania,
            'descripcion' => $request->descripcion,
            'tiempo' => $request->tiempo["id"],
            'titulo' => $request->titulo,
            'hoja_vida' => $request->hoja_vida
        ]);

        return response()->json($expNoAcademica, 201);
    }

    //consulta de todos los registros de experiencia no academica, ordenados por fecha de terminacion
    public function listNoAcademicExp()
    {
        $expNoAcademica = ExperienciaNoAcademica::orderBy('fechaFinalizacion', 'asc')
                                                    ->get();
        return response()->json($expNoAcademica, 200);
    }

    //consulta de todos los registros de experiencia no academica, por id de hoja de vida, ordenados por fecha de terminacion
    public function listNoAcademicExpByHv($idHv)
    {
        $expNoAcademica = ExperienciaNoAcademica::where("hoja_vida","=",$idHv)
                                                    ->orderBy('fechaFinalizacion', 'asc')
                                                    ->get();

        return response()->json($expNoAcademica, 200);
    }

    //consultar un registro de experiencia no academica por id
    public function getNoAcademicExpById($id)
    {
        $expNoAcademica = ExperienciaNoAcademica::find($id);
        if (is_null($expNoAcademica)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        $detalleTiempo = DetalleTipoReferencia::where("id","=",$expNoAcademica->tiempo)
                                                ->first();

        $expNoAcademica->tiempo = $detalleTiempo;
        return response()->json($expNoAcademica, 200);
    }

    //actualizar informacion de un registro de experiencia no academica
    public function updateNoAcademicExp(Request $request, $id)
    {
        //se verifica si el registro existe
        $expNoAcademica = ExperienciaNoAcademica::find($id);
        if (is_null($expNoAcademica)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        
        $expNoAcademica->fechaFinalizacion = $request->fechaFinalizacion;
        $expNoAcademica->fechaInicio = $request->fechaInicio;
        $expNoAcademica->compania = $request->compania;
        $expNoAcademica->descripcion = $request->descripcion;
        $expNoAcademica->tiempo = $request->tiempo["id"];
        $expNoAcademica->titulo = $request->titulo;

        $result = $expNoAcademica->save();

        if ($result) {
            return response()->json($expNoAcademica, 201);
        } else {
            return response()->json(['message' => 'Registro no actualizado'], 400);
        }
    }

    //eliminar un registro de experiencia no academica
    public function deleteNoAcademicExp($id)
    {
        //se verifica si el registro existe
        $expNoAcademica = ExperienciaNoAcademica::find($id);
        if (is_null($expNoAcademica)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        $expNoAcademica->delete();
        return response()->json(['message' => 'Registro eliminado'], 200);
    }
}
