<?php

namespace App\Http\Controllers;

use App\Models\TemasCurso;
use Illuminate\Http\Request;

class TemasCursoController extends Controller
{
    public function index()
    {
        return TemasCurso::all();
    }

    //registro de un tema de curso
    public function register(Request $request)
    {
        $temaCurso = TemasCurso::create([
            'nombre' => $request->nombre,
            'curso' => $request->curso
        ]);

        return response()->json($temaCurso, 201);
    }

    //consulta de todos los temas de cursos, ordenados por nombre
    public function listTopics()
    {
        $temaCurso = TemasCurso::orderBy('nombre', 'asc')
                        ->get();
        return response()->json($temaCurso, 200);
    }

    //consulta de todos los temas de cursos, por id de curso, ordenados por nombre
    public function listTopicsByC($idC)
    {
        $temaCurso = TemasCurso::where("curso","=",$idC)
                            ->orderBy('nombre', 'asc')
                            ->get();

        return response()->json($temaCurso, 200);
    }

    //consultar un tema de curso por id
    public function getTopicsById($id)
    {
        $temaCurso = TemasCurso::find($id);
        if (is_null($temaCurso)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        return response()->json($temaCurso, 200);
    }

    //actualizar informacion de un tema de curso
    public function updateTopics(Request $request, $id)
    {
        //se verifica si el registro existe
        $temaCurso = TemasCurso::find($id);
        if (is_null($temaCurso)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        
        $temaCurso->nombre = $request->nombre;
        $result = $temaCurso->save();

        if ($result) {
            return response()->json($temaCurso, 201);
        } else {
            return response()->json(['message' => 'Registro no actualizado'], 400);
        }
    }

    //eliminar un registro de un tema de curso
    public function deleteTopics($id)
    {
        //se verifica si el un tema de curso existe
        $temaCurso = TemasCurso::find($id);
        if (is_null($temaCurso)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        $temaCurso->delete();
        return response()->json(['message' => 'Registro eliminado'], 200);
    }
}
