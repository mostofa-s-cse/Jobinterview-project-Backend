<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    //function getallemployee-----------------------------------------------------
    public function getallemployee(Request $request)
    {
        try {
            $employee = User::where('role', 'Employee')->get();
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
    //function getIndividualEmployee-----------------------------------------------------
    public function getIndividualEmployee(Request $request)
    {
        try {
            $employeeActivities = DB::table('employee_activities')
            ->where('employee_id', $request->id)
            ->get();

            $employee = User::where('id', $request->id)->get();
            return response()->json( [
                'success'=>true,
                'message'=>'All Individual Employee Get Successfully',
                'data'=> $employeeActivities,
                'employee'=>$employee
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success'=>false,
                'message'=>$e->getMessage(),
            ], 500);
        }
    }
    //function function searchEmployeeActivitie Report-----------------------------------------------------
    public function searchEmployeeReport(Request $request)
    {
        try {
            $result = DB::table('employee_activities as e')
            ->where('date', $request->date)
            ->leftjoin('users as u', 'e.employee_id', '=', 'u.id')
            ->get(['e.*', 'u.name as name']);
    
            return response()->json( [
                'success'=>true,
                'message'=>'All Individual Employee Get Successfully',
                'data'=> $result,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success'=>false,
                'message'=>$e->getMessage(),
            ], 500);
        }
    }
}