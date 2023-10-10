<?php

namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Carbon;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use URL;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register','me','logout','refresh']]);
    }
    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */

   public function register( Request $request) {
        $validator = Validator::make( $request->all(), [
            'name'=>'required|string|between:3,15',
            'email'=>'required|email|unique:users',
            'password'=>'required',
        ] );
        if ( $validator->fails() ) {
            return response()->json( [
                'success'=>false,
                'message'=> $validator->errors(),
                // 'data'=>$user
            ], 400);
        }
        $user = User::create( [
            'name'=>$request->name,
            'email'=>$request->email,
            'role'=>'Employee',
            'password'=> Hash::make( $request->password )
        ] );

        return response()->json( [
            'success'=>true,
            'message'=>'Successfully Created user',
            // 'data'=>$user
        ], 200);
   }
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
      try {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $credentials = $request->only('email', 'password');
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'success'=>false,
                    'message' => 'Invalid User',
                ], 401);
            }
        }catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token','status'=>'fail'],500);
        }
        // return response()->json(['token' => $token], 200);
        return $this->respondWithToken( $token );

        }catch (\Exception $e) {
            return response()->json([
                'success'=>false,
                'message'=>$e->getMessage(),
            ], 500);
        }
    }


    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
  protected function respondWithToken( $token ) {
        return response()->json( [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'message'=>'Successfully login',
            'success'=>true,
            'data' => auth()->user()
        ]);
    }

}
