<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signIn(Request $request)
    {
        #Autenticacion
        $credentials = $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        if(!Auth::attempt($credentials)){
            return response()->json(["message" => "Credenciales incorrectas"], 401);
        }

        //Generar el token con sactun
        $user =Auth::user();
        $token = $user->createToken("Token personal")->plainTextToken;
        
        //Responder
        return response()->json([
            "access_token" => $token,
            "token_tyken" => "Bearer",
            "usuario" => $user
        ]);

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
        return response()->json(["message"=>"Usuario Registrado"], 201);
    }
    public function profile()
    {
        //Perfil de usuario
        $user = Auth::user();
        return response()->json($user);
    }
    public function signOff()
    {
        //Cerrar sesion
        Auth::user()->tokens()->delete();
        return response()->json(["message" => "Se cerró la sesión."]);
    }
}
