<?php

namespace Database\Seeders;

use App\Models\EmployeeActivities;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmployeeActivitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = EmployeeActivities::create([
            'employee_id' => 2,
            'check_in' => '10:00 PM',
            'check_out' => '05:00 PM',
            'office_hour'=>'07:00:00',
            'date'=>'2023-10-08',
            'created_at'=>'2023-10-08 20:36:39'
        ]);
        $user = EmployeeActivities::create([
            'employee_id' => 2,
            'check_in' => '10:00 PM',
            'check_out' => '05:00 PM',
            'office_hour'=>'07:00:00',
            'date'=>'2023-10-09',
            'created_at'=>'2023-10-09 20:36:39'
        ]);
        $user = EmployeeActivities::create([
            'employee_id' => 3,
            'check_in' => '10:00 PM',
            'check_out' => '05:00 PM',
            'office_hour'=>'07:00:00',
            'date'=>'2023-10-08',
            'created_at'=>'2023-10-08 20:36:39'
        ]);
        $user = EmployeeActivities::create([
            'employee_id' => 4,
            'check_in' => '10:00 PM',
            'check_out' => '05:00 PM',
            'office_hour'=>'07:00:00',
            'date'=>'2023-10-08',
            'created_at'=>'2023-10-08 20:36:39'
        ]);
        $user = EmployeeActivities::create([
            'employee_id' => 2,
            'check_in' => '10:00 PM',
            'check_out' => '05:00 PM',
            'office_hour'=>'07:00:00',
            'date'=>'2023-10-10',
            'created_at'=>'2023-10-10 20:36:39'
        ]);
        $user = EmployeeActivities::create([
            'employee_id' => 3,
            'check_in' => '10:00 PM',
            'check_out' => '05:00 PM',
            'office_hour'=>'07:00:00',
            'date'=>'2023-10-10',
            'created_at'=>'2023-10-10 20:36:39'
        ]);
    }
}
