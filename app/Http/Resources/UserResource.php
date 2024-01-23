<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->id,
            'name'            => $this->name,
            'last_name'       => $this->last_name,
            'address'         => $this->address,
            'city'            => $this->city,
            'document_number' => $this->document_number,
            'document_type'   => $this->document_type,
            'email'           => $this->email,
            'role_id'         => $this->role_id,
            'password'        => $this->password
        ];
    }
}
