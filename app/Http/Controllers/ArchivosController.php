<?php

namespace App\Http\Controllers;

use App\Models\Archivos;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArchivosController extends Controller
{
    public function index()
    {
        return Archivos::all();
    }

    //registro de archivos
    public function register(Request $request)
    {
        $file=$request->file('file');
        $uploadFolder = 'files';

        if($file){

            $file_path=time().'_'.$file->getClientOriginalName();
            $path = Storage::putFileAs($uploadFolder, new File($file), $file_path);
            $archivo = Archivos::create([
                'nombre' => $file_path,
                'path' => $path,
                'seccion' => $request->curso,
                'tipo' => $request->tipo
            ]);

            return response()->json($archivo,200);
            // return response()->json(["message" => "Ok"]);
        }

        return response()->json(["message" => "Seleccione un archivo"]);
    }

    //consulta un archivo, por id de seccion
    public function GetFileByS($idS)
    {
        $archivo = Archivos::where("seccion","=",$idS)
                            ->first();

        if (is_null($archivo)) {
            return response()->json(['message' => 'Archivo no encontrado'], 404);
        }

        
        $fileName = $archivo->nombre;
        $filePath = $archivo->path;

        if (Storage::disk('files')->exists($fileName)) {
            return Storage::get($filePath);
            return response()->json(["message" => "Existe"]);
        }else{
            return response()->json(['message' => 'Archivo no encontrado'], 404);
        }
    }

    //descargar una archivo por id
    public function getFileById($id)
    {
        $archivo = Archivos::find($id);
        if (is_null($archivo)) {
            return response()->json(['message' => 'Archivo no encontrado'], 404);
        }

        $fileName = $archivo->nombre;
        $filePath = $archivo->path;

        if (Storage::disk('files')->exists($fileName)) {

            $pathToFile = public_path($filePath);

            $headers = [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="'.$fileName.'"'
            ];
            return response()->download($pathToFile, $fileName, $headers);
        }else{
            return response()->json(['message' => 'Archivo no encontrado'], 404);
        }

    }

    //consultar Archivos por Id y seccción
    public function getFileList($idS, $tipo){

        $archivos = Archivos::where("seccion","=",$idS)
                            ->where("tipo","=",$tipo)
                            ->orderBy('nombre', 'asc')
                                        ->get();
        return response()->json($archivos, 200);
    }

    //eliminar un registro de archivo
    public function deleteFile($id)
    {
        //se verifica si el registro existe
        $archivo = Archivos::find($id);
        if (is_null($archivo)) {
            return response()->json(['message' => 'Archivo no encontrado'], 404);
        }

        $fileName = $archivo->nombre;
        $filePath = $archivo->path;

        //borra de la carpeta
        if(Storage::disk('files')->exists($fileName)){
            Storage::disk('files')->delete($fileName);
            
            //borra de la base de datos
            $archivo->delete();

            return response()->json(['message' => 'Archivo eliminado'], 200);
        }else{
            return response()->json(['message' => 'Archivo no encontrado'], 404);
        }
    }
}
