<?php

namespace App\Http\Controllers;

use App\Models\TiposReferencia;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class TiposReferenciaController extends Controller
{
    //registro de objetos tipos de referencia
    public function register(Request $request)
    {
        $tipoReferencia = TiposReferencia::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion
        ]);

        return response()->json($tipoReferencia, 201);
    }

    //consulta de todos los registros, ordenados de A-Z
    public function listTiposReferencia(){
        $tipoReferencia = TiposReferencia::orderBy('nombre', 'asc')
                                            ->get();
        return response()->json($tipoReferencia, 200);
    }

    //consultar tipo de referencia por id
    public function getTipoReferenciaById($id)
    {
        $tipoReferencia = TiposReferencia::find($id);
        if (is_null($tipoReferencia)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        return response()->json($tipoReferencia::find($id), 200);
    }

    //actualizar informacion de un tipo de referencia
    public function updateTipoReferencia(Request $request, $id)
    {
        //se verifica si el registro existe
        $tipoReferencia = TiposReferencia::find($id);
        if (is_null($tipoReferencia)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }

        $tipoReferencia->nombre = $request->nombre;
        $tipoReferencia->descripcion = $request->descripcion;

        $result = $tipoReferencia->save();

        if ($result) {
            return response()->json($tipoReferencia, 201);
        } else {
            return response()->json(['message' => 'Registro no actualizado'], 400);
        }
    }

    //eliminar un registro
    public function deleteTipoReferencia($id)//tener en cuenta lo asociado a las llaves foraneas de detalle.
    {
        try{
            //se verifica si el usuario existe
            $tipoReferencia = TiposReferencia::find($id);
            if (is_null($tipoReferencia)) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            $tipoReferencia->delete();
            return response()->json(['message' => 'Registro eliminado'], 200);

        } catch(QueryException $e) {
            $code = $e->getCode();
            switch ($code) {
                case '23503':
                    return response()->json(['message' =>'No se puede eliminar, aun tiene Detalles'], 400);
                    break;
                
                default:
                    return response()->json($e->getMessage(), 400);
                    break;
            }
        }
    }

    //obtener detalles de un tipo de referencia buscada por id
    public function getDetallesTipoReferenciaById($id)
    {
        $tipoReferencia = TiposReferencia::find($id);//busco el tipo de referencia
        if (is_null($tipoReferencia)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        $resp = $tipoReferencia->detallesTipoReferencia;//consulta de los detalles

        return response()->json($resp, 200);
    }

    //obtener detalles de un tipo de referencia buscada por el nombre
    public function getDetallesTipoReferenciaByName($name)
    {
        $tipoReferencia = TiposReferencia::where("nombre","=",$name)->first();//busco el tipo de referencia
        if (is_null($tipoReferencia)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        $resp = $tipoReferencia->detallesTipoReferencia;//consulta de los detalles

        return response()->json($resp, 200);
    }
}
