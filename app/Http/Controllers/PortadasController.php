<?php

namespace App\Http\Controllers;

use App\Models\Portadas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PortadasController extends Controller
{
    public function index()
    {
        return Portadas::all();
    }

    //registro de portadas
    public function register(Request $request)
    {
        $image=$request->file('file');
        $uploadFolder = 'covers';

        if($image){

            $image_path=time().'_'.$image->getClientOriginalName();
            // $image_uploaded_path = $image->store($uploadFolder, 'public');
            // Storage::disk('images')->put($image_path, File::get($image));
            $url = $image->storeAs($uploadFolder, $image_path);
            // $url = Storage::url($image);

            $portada = Portadas::create([
                'nombre' => $image_path,
                'path' => $url,
                'curso' => $request->curso,
                'tipo' => $request->tipo
            ]);

            return response()->json($portada,200);
            // return response()->json(["message" => "Ok"]);
        }

        return response()->json(["message" => "Seleccione un imagen"]);
    }

    //consulta una portada, por id de curso
    public function GetCoverByC($idC)
    {
        $portada = Portadas::where("curso","=",$idC)
                            ->first();

        if (is_null($portada)) {
            return response()->json(['message' => 'Portada no encontrada'], 404);
        }

        
        $fileName = $portada->nombre;
        $filePath = $portada->path;

        if (Storage::disk('covers')->exists($fileName)) {
            return Storage::get($filePath);
            // return response()->json(["message" => "Existe"]);
        }else{
            return response()->json(['message' => 'Archivo no encontrado'], 404);
        }
    }

    //consultar una portada por id
    public function getCoverById($id)
    {
        $portada = Portadas::find($id);
        if (is_null($portada)) {
            return response()->json(['message' => 'Portada no encontrada'], 404);
        }

        if (Storage::disk('images')->exists($portada->nombre)) {
            $file = Storage::get($portada->nombre);
            return response($file, 200)->header('Content-Type', 'image/*');
        }else{
            return response()->json(['message' => 'Archivo no encontrado'], 404);
        }

    }

    //consultar Archivos por Id y seccción
    public function getFileList($idS, $tipo){

        $archivos = Portadas::where("curso","=",$idS)
                            ->where("tipo","=",$tipo)
                            ->orderBy('nombre', 'asc')
                                        ->get();
        return response()->json($archivos, 200);
    }

    //actualizar registro de portada
    public function updateCover(Request $request, $id)
    {
        //se verifica si el registro existe
        $portada = Portadas::find($id);
        if (is_null($portada)) {
            return response()->json(['message' => 'Portada no encontrada'], 404);
        }
        
        if($request->has('image')){
            
            $image = new Portadas;
            $image = $request->file('image');
            $image->nombre = $request->nombre;
            $image->path = $request->path;
            $image->curso = $request->curso;
            $result = $image->save();
        }

        if ($result) {
            return response($portada, 201);
        } else {
            return response()->json(['message' => 'Registro no actualizado'], 400);
        }
    }

    //eliminar un registro de portada
    public function deleteCover($id)
    {
        //se verifica si el registro existe
        $portada = Portadas::find($id);
        if (is_null($portada)) {
            return response()->json(['message' => 'Portada no encontrada'], 404);
        }
        $portada->delete();
        return response()->json(['message' => 'Portada eliminada'], 200);
    }
}
