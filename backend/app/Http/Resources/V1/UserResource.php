<?php

namespace App\Http\Resources\V1;

use Carbon\Carbon;
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

        $rents = [];

        foreach ($this->rents()->withTrashed()->get() as $r) {

            $rent = [
                'id' => $r->id,
                'vehicleId' => $r->id,
                'rentalDuration' => $r->rental_duration,
                'createdAt' => Carbon::parse($r->created_at)->format('Y-m-d H:i:s'),
                'deletedAt' => $r->deleted_at === null ? null : Carbon::parse($r->deleted_at)->format('Y-m-d H:i:s'),
                'expiresAt' => Carbon::parse($r->created_at)->addDays($r->rental_duration)->format('Y-m-d H:i:s')
            ];

            array_push($rents, $rent);
        }

        return [
            'id' => $this->id,
            'firstName' => $firstName,
            'lastName' => $lastName,
            'name' => $this->name,
            'email' => $this->email,
            'category' => $this->category === 'ADMIN' ? 'Administrador' : 'Usuário comum',
            'rents' => $rents
        ];
    }
}
