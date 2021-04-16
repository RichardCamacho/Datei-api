<?php

namespace App\Http\Controllers;

use App\Models\ActasMejoramiento;
use Illuminate\Http\Request;

class ActasMejoramientoController extends Controller
{
    public function index()
    {
        return ActasMejoramiento::all();
    }

    //registro de acta de mejoramiento
    public function register(Request $request)
    {
        $actamejoramiento = ActasMejoramiento::create([
            'accionesPropuestas' => $request->accionesPropuestas,
            'accionesControl' => $request->accionesControl,
            'otrasAcciones' => $request->otrasAcciones,
            'accionId' => $request->accionId,
            'motivacion' => $request->motivacion,
            'objetivoEstr' => $request->objetivoEstr,
            'responsable' => $request->responsable,
            'resultadoEvaluacion' => $request->resultadoEvaluacion,
            'carpeta' => $request->carpeta
        ]);

        return response()->json($actamejoramiento, 201);
    }

    //consulta de todos los registros de actamejoramiento, ordenados por nombre
    public function listActaMejoramiento()
    {
        $actamejoramiento = ActasMejoramiento::orderBy('accionId', 'asc')
                                            ->get();
        return response()->json($actamejoramiento, 200);
    }

    //consulta de todos los registros de actamejoramiento, por id de hoja de vida, ordenados por nombre
    public function listActaMejoramientoByCso($idCSO)
    {
        $actamejoramiento = ActasMejoramiento::where("carpeta","=",$idCSO)
                                            ->orderBy('accionId', 'asc')
                                            ->get();

        return response()->json($actamejoramiento, 200);
    }

    //consultar un registro de actamejoramiento por id
    public function getActaMejoramientoById($id)
    {
        $actamejoramiento = ActasMejoramiento::find($id);
        if (is_null($actamejoramiento)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        return response()->json($actamejoramiento, 200);
    }

    //actualizar informacion de un registro de actamejoramiento
    public function updateActaMejoramiento(Request $request, $id)
    {
        //se verifica si el registro existe
        $actamejoramiento = ActasMejoramiento::find($id);
        if (is_null($actamejoramiento)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        
        $actamejoramiento->accionesPropuestas = $request->accionesPropuestas;
        $actamejoramiento->accionesControl = $request->accionesControl;
        $actamejoramiento->otrasAcciones = $request->otrasAcciones;
        $actamejoramiento->accionId = $request->accionId;
        $actamejoramiento->motivacion = $request->motivacion;
        $actamejoramiento->objetivoEstr = $request->objetivoEstr;
        $actamejoramiento->responsable = $request->responsable;
        $actamejoramiento->resultadoEvaluacion = $request->resultadoEvaluacion;

        $result = $actamejoramiento->save();

        if ($result) {
            return response()->json($actamejoramiento, 201);
        } else {
            return response()->json(['message' => 'Registro no actualizado'], 400);
        }
    }

    //eliminar un registro de actamejoramiento
    public function deleteActaMejoramiento($id)
    {
        //se verifica si el registro existe
        $actamejoramiento = ActasMejoramiento::find($id);
        if (is_null($actamejoramiento)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        $actamejoramiento->delete();
        return response()->json(['message' => 'Registro eliminado'], 200);
    }
}
