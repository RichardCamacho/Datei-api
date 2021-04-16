<?php

namespace App\Http\Controllers;

use App\Models\Libros;
use Illuminate\Http\Request;

class LibrosController extends Controller
{
    
    public function index()
    {
        return Libros::all();
    }

    //registro de libro
    public function register(Request $request)
    {
        $libro = Libros::create([
            'titulo' => $request->titulo,
            'autor' => $request->autor,
            'editorial' => $request->editorial,
            'anio' => $request->anio,
            'curso' => $request->curso
        ]);

        return response()->json($libro, 201);
    }

    //consulta de todos los libros, ordenados por nombre
    public function listBooks()
    {
        $libros = Libros::orderBy('titulo', 'asc')
                        ->get();
        return response()->json($libros, 200);
    }

    //consulta de todos los libros, por id de curso, ordenados por nombre
    public function listBooksByC($idC)
    {
        $libros = Libros::where("curso","=",$idC)
                            ->orderBy('titulo', 'asc')
                            ->get();

        return response()->json($libros, 200);
    }

    //consultar un libro por id
    public function getBooksById($id)
    {
        $libro = Libros::find($id);
        if (is_null($libro)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        return response()->json($libro, 200);
    }

    //actualizar informacion de un libro
    public function updateBooks(Request $request, $id)
    {
        //se verifica si el registro existe
        $libro = Libros::find($id);
        if (is_null($libro)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        
        $libro->titulo = $request->titulo;
        $libro->autor = $request->autor;
        $libro->editorial = $request->editorial;
        $libro->anio = $request->anio;
        $result = $libro->save();

        if ($result) {
            return response()->json($libro, 201);
        } else {
            return response()->json(['message' => 'Registro no actualizado'], 400);
        }
    }

    //eliminar un registro de libro
    public function deleteBooks($id)
    {
        //se verifica si el libro existe
        $libro = Libros::find($id);
        if (is_null($libro)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        $libro->delete();
        return response()->json(['message' => 'Registro eliminado'], 200);
    }
}
