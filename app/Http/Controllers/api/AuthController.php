<?php

namespace App\Http\Controllers\api;

use Auth;
use Validator;
use App\Models\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\BaseController;


class AuthController extends BaseController
{
    public function register(Request $request){
        $validation = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validation->fails()) {
            return $this->sendError('something went rong !..', $validation->errors());
        }

        // $password = bcrypt($request->password);

        $user = User::create([
            'name'=> $request->name,
            'email'=>$request->email,
            'password'=>$request->password,
        ]);

        $success['token'] = $user->createToken('restAPI')->plainTextToken;
        $success['name'] = $user->name;
        return $this->sendResponse($success, 'you have been registerd successfully');
    }

    public function login(Request $request){
        $validation = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        if ($validation->fails()) {
            return $this->sendError('something went rong !..', $validation->errors());
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('restAPI')->plainTextToken;
            $success['name'] = $user->name;
            return $this->sendResponse($success, 'you have been login successfully');
        }else{
            return $this->sendError('Unauthorized !..', ['error'=>'Unauthorized']);
        }
    }


}
