<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\UserResource;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use HttpResponses;

    public function getAuthenticated(Request $request){
        return new UserResource($request->user());
    }

    public function login(Request $request){

        if(Auth::attempt($request->only('email', 'password'))){

            $trait = $request->user()->category === 'ADMIN' ? 'ADMIN' : 'COMMON';

            return $this->response('Autorizado', 200,[
                'authorized' => true,
                'token' => $request->user()->createToken('auth', [$trait])->plainTextToken
            ]);
        }

        return $this->response('Não autorizado', 403,['authorized' => false]);
    }

    public function logout(Request $request){
        try {
            $request->user()->currentAccessToken()->delete();
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), [], 500, ['logout' => false]);
        }

        return $this->response('Token removido', 200, ['logout' => true]);

    }
}
