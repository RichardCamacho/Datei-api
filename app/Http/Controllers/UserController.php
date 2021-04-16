<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\DetalleTipoReferencia;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function user(Request $request)
    {
        return $request->user();
    }

    //registro de usuarios
    public function register(Request $request)
    {
        // dd($request->all());

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'primerNombre' => $request->primerNombre,
            'segundoNombre' => $request->segundoNombre,
            'primerApellido' => $request->primerApellido,
            'segundoApellido' => $request->segundoApellido,
            'rango' => $request->rango["id"],//requiero almacenar solo el id
            'rol' => $request->rol["id"],//requiero almacenar solo el id
            'programa' => $request->programa["id"]//requiero almacenar solo el id
        ]);

        return response()->json($user, 201);
    }

    //consulta de todos los usuarios, ordenados de A-Z
    public function listUSers()
    {
        $users = User::orderBy('primerNombre', 'asc')
            ->get();
        return response()->json($users, 200);
    }

    //consultar usuario por id
    public function getUserById($id)
    {
        $user = User::find($id);
        if (is_null($user)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        $detalleRol = DetalleTipoReferencia::where("id","=",$user->rol)
                                            ->first();
        $detallePrograma = DetalleTipoReferencia::where("id","=",$user->programa)
                                            ->first();
        $detalleRango = DetalleTipoReferencia::where("id","=",$user->rango)
                                            ->first();
        $user->rol = $detalleRol;
        $user->programa = $detallePrograma;
        $user->rango = $detalleRango;

        return response()->json($user, 200);
    }

    //actualizar informacion de usuario
    public function updateUser(Request $request, $id)
    {
        //se verifica si el usuario existe
        $user = User::find($id);
        if (is_null($user)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }

        $user->email = $request->email;
        $user->primerNombre = $request->primerNombre;
        $user->segundoNombre = $request->segundoNombre;
        $user->primerApellido = $request->primerApellido;
        $user->segundoApellido = $request->segundoApellido;
        $user->rango = $request->rango["id"];
        $user->rol = $request->rol["id"];
        $user->programa = $request->programa["id"];

        $result = $user->save();

        if ($result) {
            return response()->json($user, 201);
        } else {
            return response()->json(['message' => 'Registro no actualizado'], 400);
        }
    }

    //eliminar un registro de usuario
    public function deleteUser($id)
    {
        //se verifica si el usuario existe
        $user = User::find($id);
        if (is_null($user)) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        $user->delete();
        return response()->json(['message' => 'Registro eliminado'], 200);
    }
}
