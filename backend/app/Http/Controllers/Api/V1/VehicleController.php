<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\VehicleResource;
use App\Models\Vehicle;
use App\Models\VehicleDescritive;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class VehicleController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filterParam = $request->query('filter');

        if (!isset($filterParam)){
            return VehicleResource::collection(Vehicle::with('vehicleDescritive')->get());
        }

        return VehicleResource::collection(
            Vehicle::where('brand', 'like', '%' . $filterParam . '%')
            ->orWhere('model', 'like', '%' . $filterParam . '%')
            ->orWhere('plate', 'like', '%' . $filterParam . '%')
            ->orWhereHas('vehicleDescritive', function($query) use ($filterParam){
                $query->where('color', 'like', '%' . $filterParam . '%')
                ->orWhere('ports', 'like', '%' . $filterParam . '%')
                ->orWhere('transmission', 'like', '%' . $filterParam . '%');
            })
            ->get()
        );

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
        return new VehicleResource($vehicle);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $params = $request->all();

        if(isset($params['plate'])){
            $params['plate'] = str_replace('-', '', strtoupper($request->plate));
        }

        $vehicleValidator = Validator::make([
            'brand' => $params['brand'] ?? null,
            'model' => $params['model'] ?? null,
            'img' => $params['img'] ?? null,
            'price' => $params['price'] ?? null,
            'plate' => $params['plate'] ?? null,
            'category_id' => $params['categoryId'] ?? null
        ], [
            'brand' => 'nullable|max:50',
            'model' => 'nullable|max:80',
            'img' => 'nullable|file|mimes:jpeg,png,gif',
            'price' => 'nullable|numeric|between:0,9999999.99',
            'plate' => ['nullable','string', 'regex:/^[A-Z]{3}\d{4}$|^[A-Z]{3}\d[A-Z]\d{2}$/'],
            'categoryId' => 'nullable|numeric',
        ]);

        $vehicleDescritiveValidator = Validator::make([
            'color' => $params['color'] ?? null,
            'ports' => $params['ports'] ?? null,
            'transmission' => $params['transmission'] ?? null
        ], [
            'color' => 'nullable|max:100',
            'ports' => 'nullable|numeric|between:1,100',
            'transmission' => 'nullable|max:80'
        ]);

        if($vehicleValidator->fails()){
            return $this->error('Validação falhou', $vehicleValidator->errors(), 422);
        }

        if($vehicleDescritiveValidator->fails()){
            return $this->error('Validação falhou', $vehicleDescritiveValidator->errors(), 422);
        }

        $vehicleValidated = $vehicleValidator->validated();
        $vehicleDescritiveValidated = $vehicleDescritiveValidator->validated();

        $vehicle->load('vehicleDescritive');

        foreach ($vehicleValidated as $key => $value) {
            if($key === 'img'){
                continue;
            }

            if(isset($value)){
                $vehicle->{$key} = $value;
            }
        }

        foreach ($vehicleDescritiveValidated as $key => $value) {
            if(isset($value)){
                $vehicle->vehicleDescritive->{$key} = $value;
            }
        }

        try {
            if(isset($vehicleValidated['img'])){
                $imagePath = $request->file('img')->store('images');
                Storage::delete($vehicle->img);
                $vehicle->img = $imagePath;
            }

            $updated = $vehicle->save() && $vehicle->vehicleDescritive->save();

        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), [], 500, $vehicle);
        }

        if(!$updated){
            return $this->error('Item não atualizado',['updated' => false], 400, $vehicle);
        }

        return $this->response('Atualizado com sucesso!', 200, new VehicleResource($vehicle));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        $deleted = false;

        try {
            $deleted = $vehicle->delete();
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), [], 500, $vehicle);
        }

        if(!$deleted){
            return $this->error('Algo de errado ocorreu na exclusão do item', [], 400, $vehicle);
        }

        return $this->response('', 204);
    }
}
