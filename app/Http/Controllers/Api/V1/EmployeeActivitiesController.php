<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeActivitiesController extends Controller
{
    public function checkIn(Request $request)
    {


        try {

            DB::table('employee_activities')
                ->insert([
                    'check_in' => Carbon::now()->format('g:i A'),
                    'date' => Carbon::now()->toDateString(),
                    'employee_id' => auth()->user()->id,
                    'created_at'=>Carbon::now()
                ]);

            return response()->json( [
                'success'=>true,
                'message'=>'CheckIn Successfully',
                'data'=> true
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success'=>false,
                'message'=>$e->getMessage(),
            ], 500);
        }
    }
    public function checkOut(Request $request)
    {


        try {

            DB::table('employee_activities')
                ->update([
                    'check_out' => Carbon::now()->format('g:i A'),
                    'updated_at'=>Carbon::now()
                ]);

            return response()->json( [
                'success'=>true,
                'message'=>'CheckOut Successfully',
                'data'=> true
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success'=>false,
                'message'=>$e->getMessage(),
            ], 500);
        }
    }
    public function checkIn_check(Request $request)
    {
        try {

            $exist =  DB::table('employee_activities')
                ->where('employee_id', auth()->user()->id)
                ->where('date', Carbon::now()->toDateString())
                ->where('check_in','!=', 'null')
                ->first();

            $data = false;
            if ($exist){
                $data = true;
            }
            return response()->json( [
                'success'=>true,
                'message'=>'Already Exists',
                'data'=> $data,
                'exist'=> $exist
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success'=>false,
                'message'=>$e->getMessage(),
            ], 500);
        }
    }


}
