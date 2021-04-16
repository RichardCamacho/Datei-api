<?php

namespace App\Http\Controllers;

use App\Models\DetalleTipoReferencia;
use App\Models\Docentes;
use Illuminate\Http\Request;

class DocentesController extends Controller
{
    public function index()
    {
        return Docentes::all();
    }

    //registro de docente
    public function register(Request $request)
    {
        $docente = Docentes::create([
            'nombre' => $request->nombre,
            'grupo' => $request->grupo["id"],//requiero almacenar solo el id
            'curso' => $request->curso,//requiero almacenar solo el id
            'infCurso' => $request->infCurso//requiero almacenar solo el id
        ]);

        return response()->json($docente, 201);
    }

    //consulta de todos los registros, ordenados de A-Z
    public function listFaculty(){
        $docente = Docentes::with('grupo')
                        ->orderBy('nombre', 'asc')
                        ->get();
        return response()->json($docente, 200);
    }

    //consulta de todos los registros por curso, ordenados de A-Z
    public function listFacultyByCourse($idC){
        $docente = Docentes::with('grupo')
                            ->where('curso','=',$idC)
                            ->orderBy('nombre', 'asc')
                            ->get();
        return response()->json($docente, 200);
    }

    //consultar un docente por el id
    public function getFacultyById($id)
    {
        $docente = Docentes::where("id", "=", $id)
                            ->first();
        if (is_null($docente)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        $detalleGrupo = DetalleTipoReferencia::where("id","=",$docente->grupo)
                                            ->first();

        $docente->grupo = $detalleGrupo;

        return response()->json($docente, 200);
    }

    //actualizar informacion de docente
    public function updateFaculty(Request $request, $id)
    {
        //se verifica si el curso existe
        $docente = Docentes::find($id);
        if (is_null($docente)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }

        $docente->nombre = $request->nombre;
        $docente->grupo = $request->grupo["id"];
        $docente->curso = $request->curso;
        $docente->infCurso = $request->infCurso;

        $result = $docente->save();

        if ($result) {
            return response()->json($docente, 201);
        } else {
            return response()->json(['message' => 'Registro no actualizado'], 400);
        }
    }

    //eliminar un registro de docente
    public function deleteFaculty($id)
    {
        //se verifica si el docente existe
        $docente = Docentes::find($id);
        if (is_null($docente)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        $docente->delete();
        return response()->json(['message' => 'Registro eliminado'], 200);
    }
}
