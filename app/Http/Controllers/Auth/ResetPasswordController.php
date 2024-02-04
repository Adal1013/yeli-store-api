<?php

namespace App\Http\Controllers\Auth;

use App\Models\ResetCodePassword;
//use Illuminate\Foundation\Auth\User;
use App\Http\Controllers\ApiController;
use App\Models\User;
use Illuminate\Http\Request;


class ResetPasswordController extends ApiController
{
    /**
     * Restablece la contraseña del usuario usando un código temporal.
     *
     *
     * @param  mixed $request
     * @return void
     */
    public function __invoke(Request $request)
    {
        $passwordReset = ResetCodePassword::firstWhere('code', $request->code);

        if ($passwordReset->created_at > now()->addHour()) {
            $passwordReset->delete();
            
            return response(['message' => trans('El codigo esta caducado')], 422);
        }

        $user = User::firstWhere('email', $passwordReset->email);

        $user->update($request->only('password'));

        $passwordReset->delete();

        return response()->json(["mensaje" => trans('La contraseña se ha restablecido correctamente'),200], );
    }
}