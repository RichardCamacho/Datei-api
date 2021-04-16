<?php

namespace App\Http\Controllers;

use App\Models\ActividadProfesional;
use Illuminate\Http\Request;

class ActividadProfesionalController extends Controller
{
    public function index()
    {
        return ActividadProfesional::all();
    }

    //registro de actividad profesional
    public function register(Request $request)
    {
        $actvProfesional = ActividadProfesional::create([
            'fechaFinalizacion' => $request->fechaFinalizacion,
            'fechaInicio' => $request->fechaInicio,
            'nombre' => $request->nombre,
            'hoja_vida' => $request->hoja_vida
        ]);

        return response()->json($actvProfesional, 201);
    }

    //consulta de todos los registros de actividad profesional, ordenados por fecha de terminacion
    public function listProfessionalActv()
    {
        $actvProfesional = ActividadProfesional::orderBy('fechaFinalizacion', 'asc')
                                                ->get();
        return response()->json($actvProfesional, 200);
    }

    //consulta de todos los registros de actividad profesional, por id de hoja de vida, ordenados por fecha de terminacion
    public function listProfessionalActvByHv($idHv)
    {
        $actvProfesional = ActividadProfesional::where("hoja_vida","=",$idHv)
                                                ->orderBy('fechaFinalizacion', 'asc')
                                                ->get();

        return response()->json($actvProfesional, 200);
    }

    //consultar un registro de actividad profesional por id
    public function getProfessionalActvById($id)
    {
        $actvProfesional = ActividadProfesional::find($id);
        if (is_null($actvProfesional)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        return response()->json($actvProfesional, 200);
    }

    //actualizar informacion de un registro de actividad profesional
    public function updateProfessionalActv(Request $request, $id)
    {
        //se verifica si el registro existe
        $actvProfesional = ActividadProfesional::find($id);
        if (is_null($actvProfesional)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        
        $actvProfesional->fechaFinalizacion = $request->fechaFinalizacion;
        $actvProfesional->fechaInicio = $request->fechaInicio;
        $actvProfesional->nombre = $request->nombre;
        
        $result = $actvProfesional->save();

        if ($result) {
            return response()->json($actvProfesional, 201);
        } else {
            return response()->json(['message' => 'Registro no actualizado'], 400);
        }
    }

    //eliminar un registro de actividad profesional
    public function deleteProfessionalActv($id)
    {
        //se verifica si el registro existe
        $actvProfesional = ActividadProfesional::find($id);
        if (is_null($actvProfesional)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        $actvProfesional->delete();
        return response()->json(['message' => 'Registro eliminado'], 200);
    }
}
