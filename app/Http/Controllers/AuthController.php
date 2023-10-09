<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Validator;

class AuthController extends Controller
{
    //register User
    public function register(Request $request)
    {
        // validation
        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required',
            'c_password'=>'required|same:password'
        ]);
        if($validator->fails())
        {
            $response =  [
                'success'=>false,
                'message'=>$validator->error()
            ];
            return response()->json($response,400);
        }
        $input = $request->all();
        $input['password']= Hash::make($input['password']);
        $user = User::create($input);

        $success['token'] = $user->createToken('token')->plainTextToken;
        $success['name'] = $user->name;
        return response()->json($response,200);
    }

    //Login User..............
//
//    public function login(Request $request)
//    {
//        if(Auth::attempt(['email' => $request->email, 'password' => $request->password]))
//        {
//            $user = Auth::user();
//            $success['token'] = $user->createToken('token')->plainTextToken;
//            $success['name'] = $user->name;
//
//            $response = [
//                'success'=>true,
//                'data'=>$success,
//                'messgae'=>'User Login Successfully'
//            ];
//            return response()->json($response,200);
//        }else{
//            $response = [
//                'success'=>false,
//                'message'=>'Unauthorised'
//            ];
//        }
//    }
}
