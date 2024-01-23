<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
  /**
   * Autoriza el seguimiento del código
   * si se cumplen las condiciones o reglas
   * @param bool
   * @return bool
   */
  public function authorize(): bool
  {
    return true;
  }

  /**
   * Se definen las reglas de validación
   * @param array
   * @return array
   */
  public function rules(): array
  {
    return [
        'name'            => 'required|string',
        'last_name'       => 'required|string',
        'address'         => 'required|string',
        'city'            => 'nullable|string',
        'document_number' => 'nullable|string',
        'document_type'   => 'nullable|string',
        'role_id'         => 'required',
        'email'           => 'nullable|email',
        'password'        => 'nullable|string'
    ];
  }
}
