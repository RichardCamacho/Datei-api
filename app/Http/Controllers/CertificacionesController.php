<?php

namespace App\Http\Controllers;

use App\Models\Certificaciones;
use Illuminate\Http\Request;

class CertificacionesController extends Controller
{
    public function index()
    {
        return Certificaciones::all();
    }

    //registro de certificacion
    public function register(Request $request)
    {
        $certificacion = Certificaciones::create([
            'nombre' => $request->nombre,
            'numeroCertificacion' => $request->numeroCertificacion,
            'hoja_vida' => $request->hoja_vida
        ]);

        return response()->json($certificacion, 201);
    }

    //consulta de todos los registros de certificacion, ordenados por nombre
    public function listCertification()
    {
        $certificacion = Certificaciones::orderBy('nombre', 'asc')
                                            ->get();
        return response()->json($certificacion, 200);
    }

    //consulta de todos los registros de certificacion, por id de hoja de vida, ordenados por nombre
    public function listCertificationByHv($idHv)
    {
        $certificacion = Certificaciones::where("hoja_vida","=",$idHv)
                                            ->orderBy('nombre', 'asc')
                                            ->get();

        return response()->json($certificacion, 200);
    }

    //consultar un registro de certificacion por id
    public function getCertificationById($id)
    {
        $certificacion = Certificaciones::find($id);
        if (is_null($certificacion)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        return response()->json($certificacion, 200);
    }

    //actualizar informacion de un registro de certificacion
    public function updateCertification(Request $request, $id)
    {
        //se verifica si el registro existe
        $certificacion = Certificaciones::find($id);
        if (is_null($certificacion)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        
        $certificacion->nombre = $request->nombre;
        $certificacion->numeroCertificacion = $request->numeroCertificacion;
        $result = $certificacion->save();

        if ($result) {
            return response()->json($certificacion, 201);
        } else {
            return response()->json(['message' => 'Registro no actualizado'], 400);
        }
    }

    //eliminar un registro de certificacion
    public function deleteCertification($id)
    {
        //se verifica si el registro existe
        $certificacion = Certificaciones::find($id);
        if (is_null($certificacion)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        $certificacion->delete();
        return response()->json(['message' => 'Registro eliminado'], 200);
    }
}
