<?php

namespace App\Http\Controllers;

use App\Models\ActasSo;
use Illuminate\Http\Request;

class ActasSoController extends Controller
{
    public function index()
    {
        return ActasSo::all();
    }

    //registro de acta de so
    public function register(Request $request)
    {
        $actaso = ActasSo::create([
            'nombre' => $request->nombre,
            'fechaReunion' => $request->fechaReunion,
            'lugarReunion' => $request->lugarReunion,
            'horaInicio' => $request->horaInicio,
            'horaFinalizacion' => $request->horaFinalizacion,
            'convocadoPor' => $request->convocadoPor,
            'departamento' => $request->departamento,
            'objetivo' => $request->objetivo,
            'agenda' => $request->agenda,
            'acciones' => $request->acciones,
            'fechaProxReunion' => $request->fechaProxReunion,
            'lugarProxReunion' => $request->lugarProxReunion,
            'horaProxReunion' => $request->horaProxReunion,
            'carpeta' => $request->carpeta
        ]);

        return response()->json($actaso, 201);
    }

    //consulta de todos los registros de acta so, ordenados por nombre
    public function listActaSo()
    {
        $actaso = ActasSo::orderBy('nombre', 'asc')
                                            ->get();
        return response()->json($actaso, 200);
    }

    //consulta de todos los registros de acta so, por id de carpeta de so, ordenados por nombre
    public function listActaSoByCso($idCSO)
    {
        $actaso = ActasSo::where("carpeta","=",$idCSO)
                                            ->orderBy('nombre', 'asc')
                                            ->get();

        return response()->json($actaso, 200);
    }

    //consultar un registro de actaso por id
    public function getActaSoById($id)
    {
        $actaso = ActasSo::find($id);
        if (is_null($actaso)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        return response()->json($actaso, 200);
    }

    //actualizar informacion de un registro de acta so
    public function updateActaSo(Request $request, $id)
    {
        //se verifica si el registro existe
        $actaso = ActasSo::find($id);
        if (is_null($actaso)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        
        $actaso->nombre = $request->nombre;
        $actaso->fechaReunion = $request->fechaReunion;
        $actaso->lugarReunion = $request->lugarReunion;
        $actaso->horaInicio = $request->horaInicio;
        $actaso->horaFinalizacion = $request->horaFinalizacion;
        $actaso->convocadoPor = $request->convocadoPor;
        $actaso->departamento = $request->departamento;
        $actaso->objetivo = $request->objetivo;
        $actaso->agenda = $request->agenda;
        $actaso->acciones = $request->acciones;
        $actaso->fechaProxReunion = $request->fechaProxReunion;
        $actaso->lugarProxReunion = $request->lugarProxReunion;
        $actaso->horaProxReunion = $request->horaProxReunion;

        $result = $actaso->save();

        if ($result) {
            return response()->json($actaso, 201);
        } else {
            return response()->json(['message' => 'Registro no actualizado'], 400);
        }
    }

    //eliminar un registro de actaso
    public function deleteActaSo($id)
    {
        //se verifica si el registro existe
        $actaso = ActasSo::find($id);
        if (is_null($actaso)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        $actaso->delete();
        return response()->json(['message' => 'Registro eliminado'], 200);
    }
}
