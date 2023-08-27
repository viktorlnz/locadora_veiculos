<?php

namespace App\Http\Resources\V1;

use App\Models\Rent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class VehicleResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $currentDateTime = Carbon::now()->toDateTimeString();

        $rented = Rent::where('vehicle_id', $this->id)
        ->whereRaw("created_at + INTERVAL rental_duration DAY > '$currentDateTime'")
        ->first() ? true : false;



        $this->load('category');
        return [
            'id' => $this->id,
            'brand' => $this->brand,
            'model' => $this->model,
            'img' => $this->img,
            'price' => $this->price,
            'plate' => substr($this->plate, 0, 3) . '-' . substr($this->plate, 3, 4),
            'category' => $this->category->name,
            'vehicleDescritive' => [
                'id' => $this->vehicleDescritive->id,
                'color' => $this->vehicleDescritive->color,
                'ports' => $this->vehicleDescritive->ports,
                'transmission' => $this->vehicleDescritive->transmission,
                'createdAt' => Carbon::parse($this->vehicleDescritive->created_at)->format('Y-m-d H:i:s'),
                'updatedAt' => Carbon::parse($this->vehicleDescritive->updated_at)->format('Y-m-d H:i:s')
            ],
            'rented' => $rented,
            'createdAt' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
            'updatedAt' => Carbon::parse($this->updated_at)->format('Y-m-d H:i:s')

        ];
    }
}
