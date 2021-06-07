<?php

namespace App\Http\Controllers;

use App\Models\CarpetasAsignatura;
use Illuminate\Http\Request;

class CarpetasAsignaturaController extends Controller
{
    public function index()
    {
        return CarpetasAsignatura::all();
    }

    //registro de un objetivo
    public function register(Request $request)
    {
        $carpetaAsignatura = CarpetasAsignatura::create([
            'nombre' => $request->nombre,
            'codigo' => $request->codigo,
            'indicador' => $request->indicador,
            'curriculum' => $request->curriculum,
            'curso' => $request->curso,
            'idUsuario' => $request->idUsuario
        ]);

        return response()->json($carpetaAsignatura, 201);
    }

    //consulta de todos las carpetas de asignatura, ordenados por nombre
    public function listSubjectFolder()
    {
        $carpetaAsignatura = CarpetasAsignatura::with('usuario')
                                                ->orderBy('nombre', 'asc')
                                                ->get();
        return response()->json($carpetaAsignatura, 200);
    }

    //consulta de todos las carpetas de asignatura, por id de Usuario, ordenados por nombre
    public function listSubjectFolderByC($idU)
    {
        $carpetaAsignatura = CarpetasAsignatura::where("idUsuario","=",$idU)
                            ->orderBy('nombre', 'asc')
                            ->get();

        return response()->json($carpetaAsignatura, 200);
    }

    //consulta de todos las carpetas de asignatura, por indicador, ordenados por nombre
    public function listSubjectFolderByIndicador($ind)
    {
        $carpetaAsignatura = CarpetasAsignatura::where("indicador","=",$ind)
                            ->with('asignatura')
                            ->with('usuario')
                            ->orderBy('nombre', 'asc')
                            ->get();

        return response()->json($carpetaAsignatura, 200);
    }

    //consultar un objetivo por id
    public function getSubjectFolderById($id)
    {
        $carpetaAsignatura = CarpetasAsignatura::find($id);
        if (is_null($carpetaAsignatura)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        return response()->json($carpetaAsignatura, 200);
    }

    //actualizar informacion de un objetivo
    public function updateSubjectFolder(Request $request, $id)
    {
        //se verifica si el registro existe
        $carpetaAsignatura = CarpetasAsignatura::find($id);
        if (is_null($carpetaAsignatura)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        
        $carpetaAsignatura->nombre = $request->nombre;
        $carpetaAsignatura->codigo = $request->codigo;
        $carpetaAsignatura->curriculum = $request->curriculum;
        $carpetaAsignatura->curso = $request->curso;

        $result = $carpetaAsignatura->save();

        if ($result) {
            return response()->json($carpetaAsignatura, 201);
        } else {
            return response()->json(['message' => 'Registro no actualizado'], 400);
        }
    }

    //eliminar un registro de un objetivo
    public function deleteSubjectFolder($id)
    {
        //se verifica si el un objetivo existe
        $carpetaAsignatura = CarpetasAsignatura::find($id);
        if (is_null($carpetaAsignatura)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        $carpetaAsignatura->delete();
        return response()->json(['message' => 'Registro eliminado'], 200);
    }
}

