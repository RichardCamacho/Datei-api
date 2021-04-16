<?php

namespace App\Http\Controllers;

use App\Models\Secciones;
use Illuminate\Http\Request;

class SeccionesController extends Controller
{
    public function index()
    {
        return Secciones::all();
    }

    //registro de secciones
    public function register(Request $request)
    {
        $seccion = Secciones::create([
            'nombre' => $request->nombre,
            'idCarpeta' => $request->idCarpeta
        ]);

        return response()->json($seccion, 201);
    }

    //consulta de todos los registros de secciones, ordenados por nombre
    public function listSections()
    {
        $seccion = Secciones::orderBy('nombre', 'asc')
                            ->get();
        return response()->json($seccion, 200);
    }

    //consulta de todos los registros de secciones, por id de carpeta, ordenados por nombre
    public function listSectionsByC($idC)
    {
        $seccion = Secciones::where("idCarpeta","=",$idC)
                                        ->orderBy('nombre', 'asc')
                                        ->get();

        return response()->json($seccion, 200);
    }

    //consultar un registro de secciones por id
    public function getSectionsById($id)
    {
        $seccion = Secciones::with('carpeta')
                            ->find($id);
        if (is_null($seccion)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        return response()->json($seccion, 200);
    }

    //actualizar informacion de un registro de secciones
    public function updateSections(Request $request, $id)
    {
        //se verifica si el registro existe
        $seccion = Secciones::find($id);
        if (is_null($seccion)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        
        $seccion->nombre = $request->nombre;
        $result = $seccion->save();

        if ($result) {
            return response()->json($seccion, 201);
        } else {
            return response()->json(['message' => 'Registro no actualizado'], 400);
        }
    }

    //eliminar un registro de secciones
    public function deleteSections($id)
    {
        //se verifica si el registro existe
        $seccion = Secciones::find($id);
        if (is_null($seccion)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        $seccion->delete();
        return response()->json(['message' => 'Registro eliminado'], 200);
    }
}
