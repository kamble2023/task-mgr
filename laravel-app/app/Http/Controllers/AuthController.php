<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request){
        //Validate request data
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password'
        ]);

        if($validator->fails()){
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];

            return response()->json($response, 400);
        }

        $data = $request->all();
        $data['password'] =  Hash::make($data['password']);
        $user = User::create($data);

        $success['token'] = $user->createToken(time())->plainTextToken;
        $success['name'] = $user->name;

        $response = [
            'success' => true,
            'data' => $success,
            'message' => 'User registration successfull'
        ];

        return response()->json($response, 200);
    }

    public function test(){
        echo "This is test"; exit;
    }
}
