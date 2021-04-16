<?php

namespace App\Http\Controllers;

use App\Models\Estudios;
use Illuminate\Http\Request;

class EstudiosController extends Controller
{
    public function index()
    {
        return Estudios::all();
    }

    //registro de estudios/cursos
    public function register(Request $request)
    {
        $curso = Estudios::create([
            'anioTerminacion' => $request->anioTerminacion,
            'curso' => $request->curso,
            'disciplina' => $request->disciplina,
            'institucion' => $request->institucion,
            'hoja_vida' => $request->hoja_vida
        ]);

        return response()->json($curso, 201);
    }

    //consulta de todos los estudios, ordenados por año de terminacion
    public function listSchooling()
    {
        $cursos = Estudios::orderBy('anioTerminacion', 'asc')
            ->get();
        return response()->json($cursos, 200);
    }

    //consulta de todos los estudios, por id de hoja de vida, ordenados por año de terminacion
    public function listSchoolingByHv($idHv)
    {
        $cursos = Estudios::where("hoja_vida","=",$idHv)
                            ->orderBy('anioTerminacion', 'asc')
                            ->get();

        return response()->json($cursos, 200);
    }

    //consultar un estudio/curso por id
    public function getSchoolingById($id)
    {
        $curso = Estudios::find($id);
        if (is_null($curso)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        return response()->json($curso, 200);
    }

    //actualizar informacion de curso/estudio
    public function updateSchooling(Request $request, $id)
    {
        //se verifica si el registro existe
        $curso = Estudios::find($id);
        if (is_null($curso)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        
        $curso->anioTerminacion = $request->anioTerminacion;
        $curso->curso = $request->curso;
        $curso->disciplina = $request->disciplina;
        $curso->institucion = $request->institucion;
        $result = $curso->save();

        if ($result) {
            return response()->json($curso, 201);
        } else {
            return response()->json(['message' => 'Registro no actualizado'], 400);
        }
    }

    //eliminar un registro de curso/estudio
    public function deleteSchooling($id)
    {
        //se verifica si el curso/estudio existe
        $curso = Estudios::find($id);
        if (is_null($curso)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        $curso->delete();
        return response()->json(['message' => 'Registro eliminado'], 200);
    }
}
