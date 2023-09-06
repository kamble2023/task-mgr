<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Models\User;
use App\Models\Users;

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
                'message' => $validator->errors()->first()
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

    public function login(Request $request){ //print_r($request->all()); exit;
        //Validate request data
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validator->fails()){
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];

            return response()->json($response, 400);
        }

        $data = $request->all();
        $email = $data['email'];
        $password = $data['password'];

        $user = User::where('email', '=', $email)->first(); 
        if (!$user) {
            return response()->json(['success'=>false, 'message' => 'Login Fail, please check email id']);
         }

         if (!Hash::check($password, $user->password)) {
            return response()->json(['success'=>false, 'message' => 'Login Fail, pls check password']);
         }
        

        $success['token'] = $user->createToken(time())->plainTextToken;
        $success['name'] = $user->name;
        $success['user_id'] = $user->id;

        $response = [
            'success' => true,
            'data' => $success,
            'message' => 'User login successfull'
        ];

        return response()->json($response, 200);
    }

    public function logout(Request $request){

    }


    public function updateProfile(Request $request){
        //Validate request data
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email'
            
        ]);

        if($validator->fails()){
            $response = [
                'success' => false,
                'message' => $validator->errors()->first()
            ];

            return response()->json($response, 400);
        }

        $user_id = $request->user_id;
        $name = $request->name;
        $email = $request->email;

        $user = User::where("id", $user_id)->update(["name" => $name,"email"=> $email]);
        $success['name'] = $name;

        $response = [
            'success' => true,
            'data' => $success,
            'message' => 'Profile updated successfull'
        ];

        return response()->json($response, 200);
    }

    public function profile(Request $request){ 
        $u = $request->user(); 
        echo $u->name; exit;
        $user = Users::all(); 
        return view('profile',compact('user'));
    }
}
