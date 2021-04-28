<?php

namespace App\Http\Controllers;

use App\Models\DetalleTipoReferencia;
use App\Models\Estudios;
use App\Models\HojasVida;
use Illuminate\Http\Request;

class HojasVidaController extends Controller
{
    //registro de hoja de vida
    public function register(Request $request)
    {
        $hojaVida = HojasVida::create([
            'primerNombre' => $request->primerNombre,
            'segundoNombre' => $request->segundoNombre,
            'primerApellido' => $request->primerApellido,
            'segundoApellido' => $request->segundoApellido,
            'rango' => $request->rango["id"],//requiero almacenar solo el id
            'rol' => $request->rol["id"],//requiero almacenar solo el id
            'programa' => $request->programa["id"],//requiero almacenar solo el id
            'idUsuario' => $request->idUsuario,
        ]);

        return response()->json($hojaVida, 201);
    }

    //actualizar informacion de hoja de vida
    public function updateCurriculum(Request $request, $id)
    {
        //se verifica si la hoja de vida existe
        $hojaVida = HojasVida::find($id);
        if (is_null($hojaVida)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }

        $hojaVida->primerNombre = $request->primerNombre;
        $hojaVida->segundoNombre = $request->segundoNombre;
        $hojaVida->primerApellido = $request->primerApellido;
        $hojaVida->segundoApellido = $request->segundoApellido;
        $hojaVida->rango = $request->rango["id"];
        $hojaVida->rol = $request->rol["id"];
        $hojaVida->programa = $request->programa["id"];
        $hojaVida->idUsuario = $request->idUsuario;

        $result = $hojaVida->save();

        if ($result) {
            return response()->json($hojaVida, 201);
        } else {
            return response()->json(['message' => 'Registro no actualizado'], 400);
        }
    }

    public function updateDateCurriculum(Request $request, $id)
    {
        //se verifica si la hoja de vida existe
        $hojaVida = HojasVida::find($id);
        if (is_null($hojaVida)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }

        $hojaVida->updated_at = $request->updated_at;

        $result = $hojaVida->save();

        if ($result) {
            return response()->json($hojaVida, 201);
        } else {
            return response()->json(['message' => 'Registro no actualizado'], 400);
        }
    }

    //consultar una hoja de vida por el id del usuario
    public function getCurriculumByIdUser($idUsuario)
    {
        $hojaVida = HojasVida::where("idUsuario","=",$idUsuario)
                                ->first();
        if (is_null($hojaVida)) {
            return response()->json(['message' => 'Hoja de vida no encontrada'], 404);
        }
        $detalleRol = DetalleTipoReferencia::where("id","=",$hojaVida->rol)
                                            ->first();
        $detallePrograma = DetalleTipoReferencia::where("id","=",$hojaVida->programa)
                                            ->first();
        $detalleRango = DetalleTipoReferencia::where("id","=",$hojaVida->rango)
                                            ->first();
        $hojaVida->estudios;
        $hojaVida->expAcademica;
        $hojaVida->expNoAcademica;
        $hojaVida->certificaciones;
        $hojaVida->organizaciones;
        $hojaVida->premios;
        $hojaVida->activServicio;
        $hojaVida->publicaciones;
        $hojaVida->activProfesional;

        $hojaVida->rol = $detalleRol;
        $hojaVida->programa = $detallePrograma;
        $hojaVida->rango = $detalleRango;

        return response()->json($hojaVida, 200);
    }

    //consulta de todos los registros filtrados por programa con algunos detalles
    public function listCurriculumDetails($id)
    {
        $hojaVida = HojasVida:: where('programa', '=', $id)
                                ->with('rango')
                                ->with('rol')
                                ->with('programa')
                                ->get();
        return response()->json($hojaVida, 200);
    }
}
