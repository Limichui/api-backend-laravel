<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function signIn(Request $request)
    {
        #autenticacion
    }
    public function register(Request $request)
    {
        // Validar
        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users,email",
            "password" => "required"
        ]);
        // Guadar
        $usuario = new User;
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password =bcrypt($request->password);
        $usuario->save();
        // Retornar
        return response()->json(["mesaje"=>"Usuario Registrado"], 201);
    }
    public function profile()
    {
        # code...
    }
    public function signOff()
    {
        # code...
    }
}
