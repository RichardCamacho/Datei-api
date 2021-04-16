<?php

namespace App\Http\Controllers;

use App\Models\ActividadServicio;
use Illuminate\Http\Request;

class ActividadServicioController extends Controller
{
    public function index()
    {
        return ActividadServicio::all();
    }

    //registro de actividad servicio
    public function register(Request $request)
    {
        $actvServicio = ActividadServicio::create([
            'fechaFinalizacion' => $request->fechaFinalizacion,
            'fechaInicio' => $request->fechaInicio,
            'nombre' => $request->nombre,
            'entidad' => $request->entidad,
            'hoja_vida' => $request->hoja_vida
        ]);

        return response()->json($actvServicio, 201);
    }

    //consulta de todos los registros de actividad servicio, ordenados por fecha de terminacion
    public function listServiceActv()
    {
        $actvServicio = ActividadServicio::orderBy('fechaFinalizacion', 'asc')
                                                ->get();
        return response()->json($actvServicio, 200);
    }

    //consulta de todos los registros de actividad servicio, por id de hoja de vida, ordenados por fecha de terminacion
    public function listServiceActvByHv($idHv)
    {
        $actvServicio = ActividadServicio::where("hoja_vida","=",$idHv)
                                                ->orderBy('fechaFinalizacion', 'asc')
                                                ->get();

        return response()->json($actvServicio, 200);
    }

    //consultar un registro de actividad servicio por id
    public function getServiceActvById($id)
    {
        $actvServicio = ActividadServicio::find($id);
        if (is_null($actvServicio)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        return response()->json($actvServicio, 200);
    }

    //actualizar informacion de un registro de actividad servicio
    public function updateServiceActv(Request $request, $id)
    {
        //se verifica si el registro existe
        $actvServicio = ActividadServicio::find($id);
        if (is_null($actvServicio)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        
        $actvServicio->fechaFinalizacion = $request->fechaFinalizacion;
        $actvServicio->fechaInicio = $request->fechaInicio;
        $actvServicio->nombre = $request->nombre;
        $actvServicio->entidad = $request->entidad;
        
        $result = $actvServicio->save();

        if ($result) {
            return response()->json($actvServicio, 201);
        } else {
            return response()->json(['message' => 'Registro no actualizado'], 400);
        }
    }

    //eliminar un registro de actividad servicio
    public function deleteServiceActv($id)
    {
        //se verifica si el registro existe
        $actvServicio = ActividadServicio::find($id);
        if (is_null($actvServicio)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        $actvServicio->delete();
        return response()->json(['message' => 'Registro eliminado'], 200);
    }
}

