<?php

namespace App\Http\Controllers;

use App\Models\StudentOutcomes;
use Illuminate\Http\Request;

class StudentOutcomesController extends Controller
{
    public function index()
    {
        return StudentOutcomes::all();
    }

    //registro de student Outcome
    public function register(Request $request)
    {
        $studentOutcome = StudentOutcomes::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'curso' => $request->curso
        ]);

        return response()->json($studentOutcome, 201);
    }

    //consulta de todos los student Outcome, ordenados por nombre
    public function listStudentOutcomes()
    {
        $studentOutcome = StudentOutcomes::orderBy('nombre', 'asc')
                                        ->get();
        return response()->json($studentOutcome, 200);
    }

    //consulta de todos los student Outcome, por id de curso, ordenados por nombre
    public function listStudentOutcomesByC($idC)
    {
        $studentOutcome = StudentOutcomes::where("curso","=",$idC)
                                        ->orderBy('nombre', 'asc')
                                        ->get();

        return response()->json($studentOutcome, 200);
    }

    //consultar un student Outcome por id
    public function getStudentOutcomesById($id)
    {
        $studentOutcome = StudentOutcomes::find($id);
        if (is_null($studentOutcome)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        return response()->json($studentOutcome, 200);
    }

    //actualizar informacion de un student Outcome
    public function updateStudentOutcomes(Request $request, $id)
    {
        //se verifica si el registro existe
        $studentOutcome = StudentOutcomes::find($id);
        if (is_null($studentOutcome)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        
        $studentOutcome->nombre = $request->nombre;
        $studentOutcome->descripcion = $request->descripcion;
        $result = $studentOutcome->save();

        if ($result) {
            return response()->json($studentOutcome, 201);
        } else {
            return response()->json(['message' => 'Registro no actualizado'], 400);
        }
    }

    //eliminar un registro de student Outcome
    public function deleteStudentOutcomes($id)
    {
        //se verifica si el student Outcome existe
        $studentOutcome = StudentOutcomes::find($id);
        if (is_null($studentOutcome)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        $studentOutcome->delete();
        return response()->json(['message' => 'Registro eliminado'], 200);
    }
}
