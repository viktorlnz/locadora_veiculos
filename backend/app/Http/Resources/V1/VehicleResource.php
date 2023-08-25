<?php

namespace App\Http\Resources\V1;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $createdAt = Carbon::parse($this->vehicleDescritive->created_at)->format('Y-m-d H:i:s');

        $updatedAt = Carbon::parse($this->vehicleDescritive->updated_at)->format('Y-m-d H:i:s');

        return [
            'id' => $this->id,
            'brand' => $this->brand,
            'model' => $this->model,
            'img' => $this->img,
            'price' => $this->price,
            'plate' => substr($this->plate, 0, 3) . '-' . substr($this->plate, 3, 4),
            'vehicleDescritive' => [
                'id' => $this->vehicleDescritive->id,
                'color' => $this->vehicleDescritive->color,
                'ports' => $this->vehicleDescritive->ports,
                'transmission' => $this->vehicleDescritive->transmission,
                'createdAt' => $createdAt,
                'updatedAt' => $updatedAt
            ]

        ];
    }
}
