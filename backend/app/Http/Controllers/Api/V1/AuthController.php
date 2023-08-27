<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//1|laravel_sanctum_UGtNl0X9kwOXPJ1Fhrz9sRdM6qOSdTy1CPKbIjj001bbe807
class AuthController extends Controller
{
    use HttpResponses;

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

    }
}
