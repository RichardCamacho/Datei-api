<?php

namespace App\Http\Controllers;

use App\Models\DetalleTipoReferencia;
use App\Models\InformacionCurso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InformacionCursoController extends Controller
{
    //registro de curso
    public function register(Request $request)
    {
        $informacion = InformacionCurso::create([
            'codigo' => $request->codigo,
            'nombreEspaniol' => $request->nombreEspaniol,
            'nombreIngles' => $request->nombreIngles,
            'numeroCreditos' => $request->numeroCreditos,
            'horasSemestre' => $request->horasSemestre,
            'tipoCurso' => $request->tipoCurso["id"],//requiero almacenar solo el id
            'informacion' => $request->informacion,
            'titulo' => $request->titulo,
            'autor' => $request->autor,
            'editorial' => $request->editorial,
            'anio' => $request->anio,
            'filename' => $request->filename,
            'idUsuario' => $request->idUsuario,
            'idCurso' => $request->idCurso
        ]);

        return response()->json($informacion, 201);
    }

    //consulta una lista de cursos segun el usuario
    public function listSubjectInfByIdUser($idUsuario)
    {
        $informacion = InformacionCurso::where("idUsuario","=",$idUsuario)
                                        ->orderBy('codigo', 'asc')
                                        ->get();

        return response()->json($informacion, 200);
    }

    //consultar un curso por el id del usuario y el propio id
    public function getSubjectInfById($id)
    {
        $informacion = InformacionCurso::where("id", "=", $id)
                                        ->first();
        if (is_null($informacion)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }

        return response()->json($informacion, 200);
    }

    //consultar un curso por el id del usuario y el propio id con detalles
    public function getSubjectInfDetById($id)
    {
        $informacion = InformacionCurso::where("id", "=", $id)
                                        ->first();
        if (is_null($informacion)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        $detalleTipoCurso = DetalleTipoReferencia::where("id","=",$informacion->tipoCurso)
                                            ->first();
        $informacion->libros;
        $informacion->prerequisitos;
        $informacion->objetivos;
        $informacion->studentOutcomes;
        $informacion->temasCurso;
        $informacion->docentes;

        $informacion->tipoCurso = $detalleTipoCurso;

        return response()->json($informacion, 200);
    }

    //actualizar informacion de curso
    public function updateSubjectInf(Request $request, $id)
    {
        //se verifica si el curso existe
        $informacion = InformacionCurso::find($id);
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
        $informacion->titulo = $request->titulo;
        $informacion->autor = $request->autor;
        $informacion->editorial = $request->editorial;
        $informacion->anio = $request->anio;
        $informacion->filename = $request->filename;
        $informacion->idUsuario = $request->idUsuario;
        $informacion->idCurso = $request->idCurso;

        $result = $informacion->save();

        if ($result) {
            return response()->json($informacion, 201);
        } else {
            return response()->json(['message' => 'Registro no actualizado'], 400);
        }
    }

    //eliminar un registro de curso
    public function deleteSubjectInf($id)
    {
        //se verifica si el curso/estudio existe
        $informacion = InformacionCurso::find($id);
        if (is_null($informacion)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        $informacion->delete();
        return response()->json(['message' => 'Registro eliminado'], 200);
    }
}
