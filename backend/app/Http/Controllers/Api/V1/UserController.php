<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return UserResource::collection(User::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $category = 'COMMON')
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|max:255'
        ]);

        if($validator->fails()){
            return $this->error('Dados inválidos', $validator->errors(), 422);
        }

        $user = $validator->validated();
        $user['category'] = $category;

        try {
            $created = User::create($user);

            if(!$created){
                return $this->error('Algo de errado ocorreu', [], 400);
            }

            return $this->response('Cadastrado com sucesso!', 200, new UserResource($created));
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), [], 500, $user);
        }

    }

    public function storeAdmin(Request $request)
    {
        return $this->store($request, 'ADMIN');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return new UserResource($user);
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
