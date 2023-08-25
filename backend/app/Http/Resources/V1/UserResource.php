<?php

namespace App\Http\Resources\V1;

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
        $nameExplode = explode(' ', $this->name);
        $firstName = array_shift($nameExplode);
        $lastName = implode(' ', $nameExplode);

        return [
            'id' => $this->id,
            'firstName' => $firstName,
            'lastName' => $lastName,
            'name' => $this->name,
            'email' => $this->email,
            'category' => $this->category === 'ADMIN' ? 'Administrador' : 'Usuário comum'
        ];
    }
}
