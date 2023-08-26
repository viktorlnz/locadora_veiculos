<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\RentResource;
use App\Models\Rent;
use App\Traits\HttpResponses;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RentController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return RentResource::collection(Rent::withTrashed()->with('vehicle')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $params = $request->all();

        $validator = Validator::make($params, [
            'vehicleId' => 'required|numeric',
            'userId' => 'required|numeric',
            'rentalDuration' => 'required|numeric|between:1,9999',
        ]);

        if($validator->fails()){
            return $this->error('Dados inválidos', $validator->errors(), 422);
        }

        $validated = $validator->validated();

        $rent = new Rent([
            'vehicle_id' => $validated['vehicleId'],
            'user_id' => $validated['userId'],
            'rental_duration' => $validated['rentalDuration']
        ]);

        $user = \App\Models\User::where('id', $rent->user_id)->first();

        if($user->category === 'ADMIN'){
            return $this->error('Administrador não pode alugar veículo', [], 422, $user);
        }

        $currentDateTime = Carbon::now()->toDateTimeString();

        $alreadyInExecutionRent = Rent::where('vehicle_id', $rent->vehicle_id)
        ->whereRaw("created_at + INTERVAL rental_duration DAY > '$currentDateTime'")
        ->first();

        if($alreadyInExecutionRent || true){
            return $this->error('Esse veículo já está alugado.', [], 422, $alreadyInExecutionRent);
        }

        try {

            $created = $rent->save();

            if(!$created){
                return $this->error('Algo de errado ocorreu', [], 400);
            }

            return $this->response('Cadastrado com sucesso!', 200, new RentResource($rent));
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), [], 500, $rent);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rent = Rent::withTrashed()->findOrFail($id);
        return new RentResource($rent);
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
    public function destroy(Rent $rent)
    {
        $deleted = false;

        try {
            $deleted = $rent->delete();
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), [], 500, $rent);
        }

        if(!$deleted){
            return $this->error('Algo de errado ocorreu na exclusão do item', [], 400, $rent);
        }

        return $this->response('', 204);
    }
}
