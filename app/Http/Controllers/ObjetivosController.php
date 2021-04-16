<?php

namespace App\Http\Controllers;

use App\Models\Objetivos;
use Illuminate\Http\Request;

class ObjetivosController extends Controller
{
    public function index()
    {
        return Objetivos::all();
    }

    //registro de un objetivo
    public function register(Request $request)
    {
        $Objetivo = Objetivos::create([
            'nombre' => $request->nombre,
            'curso' => $request->curso
        ]);

        return response()->json($Objetivo, 201);
    }

    //consulta de todos los objetivos, ordenados por nombre
    public function listObjectives()
    {
        $Objetivo = Objetivos::orderBy('nombre', 'asc')
                            ->get();
        return response()->json($Objetivo, 200);
    }

    //consulta de todos los objetivos, por id de curso, ordenados por nombre
    public function listObjectivesByC($idC)
    {
        $Objetivo = Objetivos::where("curso","=",$idC)
                            ->orderBy('nombre', 'asc')
                            ->get();

        return response()->json($Objetivo, 200);
    }

    //consultar un objetivo por id
    public function getObjectivesById($id)
    {
        $Objetivo = Objetivos::find($id);
        if (is_null($Objetivo)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        return response()->json($Objetivo, 200);
    }

    //actualizar informacion de un objetivo
    public function updateObjectives(Request $request, $id)
    {
        //se verifica si el registro existe
        $Objetivo = Objetivos::find($id);
        if (is_null($Objetivo)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        
        $Objetivo->nombre = $request->nombre;
        $result = $Objetivo->save();

        if ($result) {
            return response()->json($Objetivo, 201);
        } else {
            return response()->json(['message' => 'Registro no actualizado'], 400);
        }
    }

    //eliminar un registro de un objetivo
    public function deleteObjectives($id)
    {
        //se verifica si el un objetivo existe
        $Objetivo = Objetivos::find($id);
        if (is_null($Objetivo)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        $Objetivo->delete();
        return response()->json(['message' => 'Registro eliminado'], 200);
    }
}
