<?php

namespace App\Http\Controllers;

use App\Models\Publicaciones;
use Illuminate\Http\Request;

class PublicacionesController extends Controller
{
    public function index()
    {
        return Publicaciones::all();
    }

    //registro de publicacion
    public function register(Request $request)
    {
        $publicacion = Publicaciones::create([
            'fechaPublicacion' => $request->fechaPublicacion,
            'lugarPublicacion' => $request->lugarPublicacion,
            'titulo' => $request->titulo,
            'hoja_vida' => $request->hoja_vida
        ]);

        return response()->json($publicacion, 201);
    }

    //consulta de todos los registros de publicacion, ordenados por fecha de publicacion
    public function listPublication()
    {
        $publicacion = Publicaciones::orderBy('fechaPublicacion', 'asc')
                                            ->get();
        return response()->json($publicacion, 200);
    }

    //consulta de todos los registros de publicacion, por id de hoja de vida, ordenados por nombre
    public function listPublicationByHv($idHv)
    {
        $publicacion = Publicaciones::where("hoja_vida","=",$idHv)
                                            ->orderBy('fechaPublicacion', 'asc')
                                            ->get();

        return response()->json($publicacion, 200);
    }

    //consultar un registro de publicacion por id
    public function getPublicationById($id)
    {
        $publicacion = Publicaciones::find($id);
        if (is_null($publicacion)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        $publicacion->coautores;
        
        return response()->json($publicacion, 200);
    }

    //actualizar informacion de un registro de publicacion
    public function updatePublication(Request $request, $id)
    {
        //se verifica si el registro existe
        $publicacion = Publicaciones::find($id);
        if (is_null($publicacion)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        
        $publicacion->fechaPublicacion = $request->fechaPublicacion;
        $publicacion->lugarPublicacion = $request->lugarPublicacion;
        $publicacion->titulo = $request->titulo;
        $result = $publicacion->save();

        if ($result) {
            return response()->json($publicacion, 201);
        } else {
            return response()->json(['message' => 'Registro no actualizado'], 400);
        }
    }

    //eliminar un registro de publicacion
    public function deletePublication($id)
    {
        //se verifica si el registro existe
        $publicacion = Publicaciones::find($id);
        if (is_null($publicacion)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        $publicacion->delete();
        return response()->json(['message' => 'Registro eliminado'], 200);
    }
}
