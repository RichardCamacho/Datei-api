<?php

namespace App\Http\Controllers;

use App\Models\Premios;
use Illuminate\Http\Request;

class PremiosController extends Controller
{
    public function index()
    {
        return Premios::all();
    }

    //registro de premios
    public function register(Request $request)
    {
        $premio = Premios::create([
            'nombre' => $request->nombre,
            'hoja_vida' => $request->hoja_vida
        ]);

        return response()->json($premio, 201);
    }

    //consulta de todos los registros de premios, ordenados por nombre
    public function listAwards()
    {
        $premio = Premios::orderBy('nombre', 'asc')
                                        ->get();
        return response()->json($premio, 200);
    }

    //consulta de todos los registros de premios, por id de hoja de vida, ordenados por nombre
    public function listAwardsByHv($idHv)
    {
        $premio = Premios::where("hoja_vida","=",$idHv)
                                        ->orderBy('nombre', 'asc')
                                        ->get();

        return response()->json($premio, 200);
    }

    //consultar un registro de premios por id
    public function getAwardsById($id)
    {
        $premio = Premios::find($id);
        if (is_null($premio)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        return response()->json($premio, 200);
    }

    //actualizar informacion de un registro de premios
    public function updateAwards(Request $request, $id)
    {
        //se verifica si el registro existe
        $premio = Premios::find($id);
        if (is_null($premio)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        
        $premio->nombre = $request->nombre;
        $result = $premio->save();

        if ($result) {
            return response()->json($premio, 201);
        } else {
            return response()->json(['message' => 'Registro no actualizado'], 400);
        }
    }

    //eliminar un registro de premios
    public function deleteAwards($id)
    {
        //se verifica si el registro existe
        $premio = Premios::find($id);
        if (is_null($premio)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        $premio->delete();
        return response()->json(['message' => 'Registro eliminado'], 200);
    }
}
