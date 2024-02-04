<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller 
{
    /**
     * Valida los datos del usuario entrante y crea un nuevo usuario en la base de datos.
     * Si la creación es exitosa, devuelve un token de autenticación para el usuario.
     * @param Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'            => 'required|string|max:255',
            'last_name'       => 'required|string|max:255',
            'address'         => 'required|string|max:255',
            'city'            => 'required|string|max:255',
            'document_number' => 'required|string|max:255',
            'document_type'   => 'required|string|max:255',
            'role_id'         => 'required|numeric',
            'email'           => 'required|string|email|max:255|unique:users',
            'password'        => 'required|string|min:8',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $user = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'city' => $request->city,
            'document_number' => $request->document_number,
            'document_type' => $request->document_type,
            'role_id' => $request->role_id,
            'email'   => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()
            ->json(['data' => $user, 'access_token' => $token, 'token_type' => 'Bearer' ]); 
    }

    /**
     * Intenta iniciar sesión al usuario con los datos proporcionados.
     * Si la autenticación es exitosa, devuelve un token de acceso y los datos del usuario.
     * @param  \Illuminate\Http\Request $request 
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        if (!auth::attempt($request->only('email', 'password')))
        {
            return response()->json(['message'=> 'Unauthorize'],401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message'     => 'Hi '.$user->name,
            'accessToken' => $token,
            'token_type'  => 'Bearer',
            'user'        => $user,
        ]);
    }

    /**
     * Cierra la sesión del usuario actual y elimina todos sus tokens de autenticación.
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() 
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'You have succesfully logge out and the token was succesfully deleted'
        ];
    }
}