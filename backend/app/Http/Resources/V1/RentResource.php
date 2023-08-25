<?php

namespace App\Http\Resources\V1;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $descritive = \App\Models\VehicleDescritive::where('id', $this->vehicle->vehicle_descritive_id)->first();
        $vehicle = [
            'id' => $this->vehicle->id,
            'brand' => $this->vehicle->brand,
            'model' => $this->vehicle->model,
            'img' => $this->vehicle->img,
            'price' => $this->vehicle->id,
            'plate' => substr($this->vehicle->plate, 0, 3) . '-' . substr($this->vehicle->plate, 3, 4),
            'category' => \App\Models\Category::where('id', $this->vehicle->category_id)->first()->name,
            'descritive' => [
                'id' => $descritive->id,
                'color' => $descritive->color,
                'ports' => $descritive->ports,
                'transmission' => $descritive->transmission
            ]
        ];
        return [
            'id' => $this->id,
            'vehicle' => $vehicle,
            'userId' => $this->user_id,
            'rentalDuration' => $this->rental_duration,
            'createdAt' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
            'deletedAt' => $this->deleted_at === null ? null : Carbon::parse($this->deleted_at)->format('Y-m-d H:i:s'),
            'expiresAt' => Carbon::parse($this->created_at)->addDays($this->rental_duration)->format('Y-m-d H:i:s')
        ];
    }
}
