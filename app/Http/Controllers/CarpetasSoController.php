<?php

namespace App\Http\Controllers;

use App\Models\CarpetasSo;
use Illuminate\Http\Request;

class CarpetasSoController extends Controller
{
    public function index()
    {
        return CarpetasSo::all();
    }

    //registro de una carpeta SO
    public function register(Request $request)
    {
        $carpetaSo = CarpetasSo::create([
            'nombre' => $request->nombre,
            'codigo' => $request->codigo,
            'indicador' => $request->indicador,
            'idUsuario' => $request->idUsuario
        ]);

        return response()->json($carpetaSo, 201);
    }

    //consulta de todas las carpetas de asignatura, ordenados por nombre
    public function listSoFolder()
    {
        $carpetaSo = CarpetasSo::with('usuario')
                                ->orderBy('nombre', 'asc')
                                ->get();
        return response()->json($carpetaSo, 200);
    }

    //consulta de todos las carpetas de asignatura, por id de usuario, ordenados por nombre
    public function listSoFolderByU($idU)
    {
        $carpetaSo = CarpetasSo::where("idUsuario","=",$idU)
                            ->orderBy('nombre', 'asc')
                            ->get();

        return response()->json($carpetaSo, 200);
    }

    //consultar una carpeta SO por id
    public function getSoFolderById($id)
    {
        $carpetaSo = CarpetasSo::find($id);
        if (is_null($carpetaSo)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        return response()->json($carpetaSo, 200);
    }

    //actualizar informacion de una carpeta SO
    public function updateSoFolder(Request $request, $id)
    {
        //se verifica si el registro existe
        $carpetaSo = CarpetasSo::find($id);
        if (is_null($carpetaSo)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        
        $carpetaSo->nombre = $request->nombre;
        $carpetaSo->codigo = $request->codigo;

        $result = $carpetaSo->save();

        if ($result) {
            return response()->json($carpetaSo, 201);
        } else {
            return response()->json(['message' => 'Registro no actualizado'], 400);
        }
    }

    //eliminar un registro de una carpeta SO
    public function deleteSoFolder($id)
    {
        //se verifica si una carpeta SO existe
        $carpetaSo = CarpetasSo::find($id);
        if (is_null($carpetaSo)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        $carpetaSo->delete();
        return response()->json(['message' => 'Registro eliminado'], 200);
    }
}
