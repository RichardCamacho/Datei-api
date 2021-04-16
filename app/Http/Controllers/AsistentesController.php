<?php

namespace App\Http\Controllers;

use App\Models\Asistentes;
use Illuminate\Http\Request;

class AsistentesController extends Controller
{
    public function index()
    {
        return Asistentes::all();
    }

    //registro de asistente
    public function register(Request $request)
    {
        $asistente = Asistentes::create([
            'nombre' => $request->nombre,
            'asistencia' => $request->asistencia,
            'posicion' => $request->posicion,
            'excusa' => $request->excusa,
            'idActa' => $request->idActa
        ]);

        return response()->json($asistente, 201);
    }

    //consulta de todos los registros de asistente, ordenados por nombre
    public function listAttendant()
    {
        $asistente = Asistentes::orderBy('nombre', 'asc')
                                ->get();
        return response()->json($asistente, 200);
    }

    //consulta de todos los registros de asistente, por id de acta so, ordenados por nombre
    public function listAttendantByAso($idASo)
    {
        $asistente = Asistentes::where("idActa","=",$idASo)
                                            ->orderBy('nombre', 'asc')
                                            ->get();

        return response()->json($asistente, 200);
    }

    //consultar un registro de asistente por id
    public function getAttendantById($id)
    {
        $asistente = Asistentes::find($id);
        if (is_null($asistente)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        return response()->json($asistente, 200);
    }

    //actualizar informacion de un registro de asistente
    public function updateAttendant(Request $request, $id)
    {
        //se verifica si el registro existe
        $asistente = Asistentes::find($id);
        if (is_null($asistente)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        
        $asistente->nombre = $request->nombre;
        $asistente->asistencia = $request->asistencia;
        $asistente->posicion = $request->posicion;
        $asistente->excusa = $request->excusa;

        $result = $asistente->save();

        if ($result) {
            return response()->json($asistente, 201);
        } else {
            return response()->json(['message' => 'Registro no actualizado'], 400);
        }
    }

    //eliminar un registro de asistente
    public function deleteAttendant($id)
    {
        //se verifica si el registro existe
        $asistente = Asistentes::find($id);
        if (is_null($asistente)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        $asistente->delete();
        return response()->json(['message' => 'Registro eliminado'], 200);
    }
}
