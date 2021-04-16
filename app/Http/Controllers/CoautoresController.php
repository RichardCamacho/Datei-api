<?php

namespace App\Http\Controllers;

use App\Models\Coautores;
use Illuminate\Http\Request;

class CoautoresController extends Controller
{
    public function index()
    {
        return Coautores::all();
    }

    //registro de coautor
    public function register(Request $request)
    {
        $coautor = Coautores::create([
            'nombre' => $request->nombre,
            'publicacion' => $request->publicacion,
        ]);

        return response()->json($coautor, 201);
    }

    //consulta de todos los registros de coautor, ordenados por nombre
    public function listCoauthor()
    {
        $coautor = Coautores::orderBy('nombre', 'asc')
                                ->get();
        return response()->json($coautor, 200);
    }

    //consulta de todos los registros de coautor, por id de publicacion, ordenados por nombre
    public function listCoauthorByPublication($idPb)
    {
        $coautor = Coautores::where("publicacion","=",$idPb)
                                ->orderBy('nombre', 'asc')
                                ->get();

        return response()->json($coautor, 200);
    }

    //consultar un registro de coautor por id
    public function getCoauthorById($id)
    {
        $coautor = Coautores::find($id);
        if (is_null($coautor)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        return response()->json($coautor, 200);
    }

    //actualizar informacion de un registro de coautor
    public function updateCoauthor(Request $request, $id)
    {
        //se verifica si el registro existe
        $coautor = Coautores::find($id);
        if (is_null($coautor)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        
        $coautor->nombre = $request->nombre;
        $result = $coautor->save();

        if ($result) {
            return response()->json($coautor, 201);
        } else {
            return response()->json(['message' => 'Registro no actualizado'], 400);
        }
    }

    //eliminar un registro de coautor
    public function deleteCoauthor($id)
    {
        //se verifica si el registro existe
        $coautor = Coautores::find($id);
        if (is_null($coautor)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        $coautor->delete();
        return response()->json(['message' => 'Registro eliminado'], 200);
    }
}
