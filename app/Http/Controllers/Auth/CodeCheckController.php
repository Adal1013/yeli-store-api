<?php

namespace App\Http\Controllers\Auth;

use App\Models\ResetCodePassword;
use App\Http\Controllers\ApiController;

class CodeCheckController extends ApiController
{
    /**
     * Comprueba si el código existe y es válido
     *
     * @param  mixed $request
     * @return void
     */
    public function __invoke(string $code)
    {
        $passwordReset = ResetCodePassword::firstWhere('code', $code);

        if ($passwordReset->created_at > now()->addHour()) {
            $passwordReset->delete();

            return response(['message' => trans('el codigo esta caducado'), 422], 422);
        }

        return response()->json(["mensaje" => trans('el código es válido'),422], );
    }
}