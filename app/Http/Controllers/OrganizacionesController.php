<?php

namespace App\Http\Controllers;

use App\Models\Organizaciones;
use Illuminate\Http\Request;

class OrganizacionesController extends Controller
{
    public function index()
    {
        return Organizaciones::all();
    }

    //registro de organizaciones
    public function register(Request $request)
    {
        $organizacion = Organizaciones::create([
            'nombre' => $request->nombre,
            'hoja_vida' => $request->hoja_vida
        ]);

        return response()->json($organizacion, 201);
    }

    //consulta de todos los registros de organizaciones, ordenados por nombre
    public function listOrganization()
    {
        $organizacion = Organizaciones::orderBy('nombre', 'asc')
                                        ->get();
        return response()->json($organizacion, 200);
    }

    //consulta de todos los registros de organizaciones, por id de hoja de vida, ordenados por nombre
    public function listOrganizationByHv($idHv)
    {
        $organizacion = Organizaciones::where("hoja_vida","=",$idHv)
                                        ->orderBy('nombre', 'asc')
                                        ->get();

        return response()->json($organizacion, 200);
    }

    //consultar un registro de organizaciones por id
    public function getOrganizationById($id)
    {
        $organizacion = Organizaciones::find($id);
        if (is_null($organizacion)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        return response()->json($organizacion, 200);
    }

    //actualizar informacion de un registro de organizaciones
    public function updateOrganization(Request $request, $id)
    {
        //se verifica si el registro existe
        $organizacion = Organizaciones::find($id);
        if (is_null($organizacion)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        
        $organizacion->nombre = $request->nombre;
        $result = $organizacion->save();

        if ($result) {
            return response()->json($organizacion, 201);
        } else {
            return response()->json(['message' => 'Registro no actualizado'], 400);
        }
    }

    //eliminar un registro de organizaciones
    public function deleteOrganization($id)
    {
        //se verifica si el registro existe
        $organizacion = Organizaciones::find($id);
        if (is_null($organizacion)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        $organizacion->delete();
        return response()->json(['message' => 'Registro eliminado'], 200);
    }
}
