<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\VehicleResource;
use App\Models\Vehicle;
use App\Models\VehicleDescritive;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VehicleController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return VehicleResource::collection(Vehicle::with('vehicleDescritive')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $params = $request->all();
        $params['plate'] = str_replace('-', '', strtoupper($request->plate));

        $validator = Validator::make($params, [
            'brand' => 'required|max:50',
            'model' => 'required|max:80',
            'img' => 'required|file|mimes:jpeg,png,gif',
            'price' => 'required|numeric|between:0,9999999.99',
            'plate' => ['required','string', 'regex:/^[A-Z]{3}\d{4}$|^[A-Z]{3}\d[A-Z]\d{2}$/'],
            'categoryId' => 'required|numeric',
            'color' => 'required|max:100',
            'ports' => 'required|numeric|between:1,100',
            'transmission' => 'required|max:80'
        ]);

        if($validator->fails()){
            return $this->error('Dados inválidos', $validator->errors(), 422);
        }

        $validated = $validator->validated();

        $vehicle = new Vehicle([
            'brand' => $validated['brand'],
            'model' => $validated['model'],
            'price' => $validated['price'],
            'plate' => $validated['plate'],
            'category_id' => $validated['categoryId']
        ]);

        $vehicleDescritive = new VehicleDescritive([
            'color' => $validated['color'],
            'ports' => $validated['ports'],
            'transmission' => $validated['transmission'],
        ]);

        try {
            $imagePath = $request->file('img')->store('images');
            $vehicle->img = $imagePath;

            $vehicleDescritive->save();
            $vehicle->vehicle_descritive_id = $vehicleDescritive->id;
            $created = $vehicle->save();

            if(!$created){
                return $this->error('Algo de errado ocorreu', [], 400);
            }

            return $this->response('Cadastrado com sucesso!', 200, new VehicleResource($vehicle));
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), [], 500, $vehicle);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehicle $vehicle)
    {
        echo asset('storage/images/4CYTM46aJsWiKxQHAlmpScQ3GagS2IU1HYdef5ZR.jpg');
        return new VehicleResource($vehicle);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
