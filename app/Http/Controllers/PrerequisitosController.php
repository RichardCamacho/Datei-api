<?php

namespace App\Http\Controllers;

use App\Models\DetalleTipoReferencia;
use App\Models\Prerequisitos;
use Illuminate\Http\Request;

class PrerequisitosController extends Controller
{
    public function index()
    {
        return Prerequisitos::all();
    }

    //registro de prerequisito
    public function register(Request $request)
    {
        $prerequisito = Prerequisitos::create([
            'nombre' => $request->nombre,
            'tipo' => $request->tipo["id"],
            'curso' => $request->curso
        ]);

        return response()->json($prerequisito, 201);
    }

    //consulta de todos los prerequisitos, ordenados por nombre
    public function listPrerequisites()
    {
        $prerequisitos = Prerequisitos::orderBy('nombre', 'asc')
                                        ->get();
        return response()->json($prerequisitos, 200);
    }

    //consulta de todos los prerequisitos, por id de curso, ordenados por nombre
    public function listPrerequisitesByC($idC)
    {
        $prerequisitos = Prerequisitos::with('tipo')
                                        ->where("curso","=",$idC)
                                        ->orderBy('nombre', 'asc')
                                        ->get();

        return response()->json($prerequisitos, 200);
    }

    //consultar un prerequisito por id
    public function getPrerequisitesById($id)
    {
        $prerequisito = Prerequisitos::find($id);
        if (is_null($prerequisito)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }

        $detalleTipo = DetalleTipoReferencia::where("id","=",$prerequisito->tipo)
                                            ->first();
        $prerequisito->tipo = $detalleTipo;

        return response()->json($prerequisito, 200);
    }

    //actualizar informacion de un prerequisito
    public function updatePrerequisites(Request $request, $id)
    {
        //se verifica si el registro existe
        $prerequisito = Prerequisitos::find($id);
        if (is_null($prerequisito)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        
        $prerequisito->nombre = $request->nombre;
        $prerequisito->tipo = $request->tipo["id"];
        
        $result = $prerequisito->save();

        if ($result) {
            return response()->json($prerequisito, 201);
        } else {
            return response()->json(['message' => 'Registro no actualizado'], 400);
        }
    }

    //eliminar un registro de prerequisito
    public function deletePrerequisites($id)
    {
        //se verifica si el prerequisito existe
        $prerequisito = Prerequisitos::find($id);
        if (is_null($prerequisito)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        $prerequisito->delete();
        return response()->json(['message' => 'Registro eliminado'], 200);
    }
}
