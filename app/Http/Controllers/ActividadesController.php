<?php

namespace App\Http\Controllers;

use App\Models\Actividades;
use Illuminate\Http\Request;

class ActividadesController extends Controller
{
    public function index()
    {
        return Actividades::all();
    }

    //registro de actividad
    public function register(Request $request)
    {
        $actividad = Actividades::create([
            'descripcion' => $request->descripcion,
            'fecha' => $request->fecha,
            'responsable' => $request->responsable,
            'idActa' => $request->idActa
        ]);

        return response()->json($actividad, 201);
    }

    //consulta de todos los registros de actividad, ordenados por fecha
    public function listActivity()
    {
        $actividad = Actividades::orderBy('fecha', 'asc')
                                ->get();
        return response()->json($actividad, 200);
    }

    //consulta de todos los registros de actividad, por id de acta so, ordenados por fecha
    public function listActivityByAso($idASo)
    {
        $actividad = Actividades::where("idActa","=",$idASo)
                                ->orderBy('fecha', 'asc')
                                ->get();

        return response()->json($actividad, 200);
    }

    //consultar un registro de actividad por id
    public function getActivityById($id)
    {
        $actividad = Actividades::find($id);
        if (is_null($actividad)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        return response()->json($actividad, 200);
    }

    //actualizar informacion de un registro de actividad
    public function updateActivity(Request $request, $id)
    {
        //se verifica si el registro existe
        $actividad = Actividades::find($id);
        if (is_null($actividad)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        
        $actividad->descripcion = $request->descripcion;
        $actividad->fecha = $request->fecha;
        $actividad->responsable = $request->responsable;

        $result = $actividad->save();

        if ($result) {
            return response()->json($actividad, 201);
        } else {
            return response()->json(['message' => 'Registro no actualizado'], 400);
        }
    }

    //eliminar un registro de actividad
    public function deleteActivity($id)
    {
        //se verifica si el registro existe
        $actividad = Actividades::find($id);
        if (is_null($actividad)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        $actividad->delete();
        return response()->json(['message' => 'Registro eliminado'], 200);
    }
}
