<?php

namespace App\Http\Controllers;

use App\Models\Cursos;
use App\Models\DetalleTipoReferencia;
use Illuminate\Http\Request;

class CursosController extends Controller
{
    public function index()
    {
        return Cursos::all();
    }

    //registro de curso
    public function register(Request $request)
    {
        $curso = Cursos::create([
            'codigo' => $request->codigo,
            'nombreEspaniol' => $request->nombreEspaniol,
            'nombreIngles' => $request->nombreIngles,
            'numeroCreditos' => $request->numeroCreditos,
            'horasSemestre' => $request->horasSemestre,
            'tipoCurso' => $request->tipoCurso["id"],//requiero almacenar solo el id
            'informacion' => $request->informacion
        ]);

        return response()->json($curso, 201);
    }

    //consulta de todos los registros, ordenados de A-Z
    public function listCourse(){
        $course = Cursos::with('tipoCurso')
                        ->orderBy('nombreEspaniol', 'asc')
                                            ->get();
        return response()->json($course, 200);
    }

    //consultar un curso por el id del usuario y el propio id con detalles
    public function getCourseById($id)
    {
        $informacion = Cursos::where("id", "=", $id)
                                        ->first();
        if (is_null($informacion)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        $detalleTipoCurso = DetalleTipoReferencia::where("id","=",$informacion->tipoCurso)
                                            ->first();
        
        $detalleInstructor = DetalleTipoReferencia::where("id","=",$informacion->instructor)
                                            ->first();
        

        $informacion->tipoCurso = $detalleTipoCurso;
        $informacion->instructor = $detalleInstructor;

        return response()->json($informacion, 200);
    }

    //actualizar informacion de curso
    public function updateCourse(Request $request, $id)
    {
        //se verifica si el curso existe
        $informacion = Cursos::find($id);
        if (is_null($informacion)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }

        $informacion->codigo = $request->codigo;
        $informacion->nombreEspaniol = $request->nombreEspaniol;
        $informacion->nombreIngles = $request->nombreIngles;
        $informacion->numeroCreditos = $request->numeroCreditos;
        $informacion->horasSemestre = $request->horasSemestre;
        $informacion->tipoCurso = $request->tipoCurso["id"];
        $informacion->informacion = $request->informacion;

        $result = $informacion->save();

        if ($result) {
            return response()->json($informacion, 201);
        } else {
            return response()->json(['message' => 'Registro no actualizado'], 400);
        }
    }

    //eliminar un registro de curso
    public function deleteCurso($id)
    {
        //se verifica si el curso/estudio existe
        $informacion = Cursos::find($id);
        if (is_null($informacion)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        $informacion->delete();
        return response()->json(['message' => 'Registro eliminado'], 200);
    }
}

