<?php

namespace App\Http\Controllers;

use App\Models\DetalleTipoReferencia;
use Illuminate\Http\Request;

class DetalleTipoReferenciaController extends Controller
{
    //registro de objetos tipos de referencia
    public function register(Request $request)
    {

        $detalleTipoReferencia = DetalleTipoReferencia::create([
            'nombre' => $request->nombre,
            'tipoReferencia' => $request->tipoReferencia
        ]);

        return response()->json($detalleTipoReferencia, 201);
    }

    //consulta de todos los registros, ordenados de A-Z
    public function listDetallesTipoReferencia(){
        $detalleTipoReferencia = DetalleTipoReferencia::orderBy('nombre', 'asc')
                                            ->get();
        return response()->json($detalleTipoReferencia, 200);
    }

    //consultar detalles tipo de referencia por id
    public function getDetalleTipoReferenciaById($id)
    {
        $detalleTipoReferencia = DetalleTipoReferencia::where("id", "=", $id)
                                                        ->first();
        if (is_null($detalleTipoReferencia)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        return response()->json($detalleTipoReferencia::find($id), 200);
    }

    //actualizar informacion de un detalle tipo de referencia
    public function updateDetalleTipoReferencia(Request $request, $id)
    {
        //se verifica si el registro existe
        $detalleTipoReferencia = DetalleTipoReferencia::find($id);
        if (is_null($detalleTipoReferencia)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }

        $detalleTipoReferencia->nombre = $request->nombre;
        $detalleTipoReferencia->tipoReferencia = $request->tipoReferencia;

        $result = $detalleTipoReferencia->save();

        if ($result) {
            return response()->json($detalleTipoReferencia, 201);
        } else {
            return response()->json(['message' => 'Registro no actualizado'], 400);
        }
    }

    //eliminar un registro
    public function deleteDetalleTipoReferencia($id)//tener en cuenta lo asociado a las llaves foraneas de detalle.
    {
        //se verifica si el usuario existe
        $detalleTipoReferencia = DetalleTipoReferencia::find($id);
        if (is_null($detalleTipoReferencia)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        $detalleTipoReferencia->delete();
        return response()->json(['message' => 'Registro eliminado'], 200);
    }
}
