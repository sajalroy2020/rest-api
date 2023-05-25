<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Controllers\BaseController;

class AuthController extends BaseController
{
    public function register(RegisterRequest $request){
        dd('ok');
        // $validateData = $request->validated();

        // if (User::create($validateData)) {
        //     $success['token'] = $validateData->createToken('restAPI')->plainTextToken;
        //     $success['name'] = $validateData->name;
        //     return $this->sendResponse($success, 'you have been registerd successfully');
        // }
        // return $this->sendError('something went rong !..', errors());
    }
}
