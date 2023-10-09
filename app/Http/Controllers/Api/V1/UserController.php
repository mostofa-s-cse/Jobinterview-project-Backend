<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class UserController extends Controller
{
    public function getallemployee(Request $request)
    {
        $employee = User::where('role', 'Employee')->get();
        try {
            return response()->json( [
                'success'=>true,
                'message'=>'All Employee Get Successfully',
                'data'=>$employee
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success'=>false,
                'message'=>$e->getMessage(),
            ], 500);
        }
    }

    
    public function index()
    {
       // All Product
       $products = User::all();
      
       // Return Json Response
       return response()->json([
          'products' => $products
       ],200);
    }
}
