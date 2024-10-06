<?php

namespace App\Http\Controllers\admin;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function home()
    {

        $employees = User::Where('user_type' , 'employee')->count();
        $managers = User::Where('user_type' , 'manager')->count();

        return view('admin.dashboard' , ['employees'=>$employees , 'managers'=>$managers]);
    }

    public function showOneEmployee($id)
    {
        $employee = User::findOrFail($id);
        $tasks = $employee->tasks;
        return view('admin.employee.showOne' , ['employee' => $employee , 'tasks' => $tasks]);
    }

    public function showEmployeeTask(Request $request , $id)
    {
        $date = $request->date;

        if($date)
        {
            $tasks = Task::where('user_id' , $id)
                         ->whereDate('start_time' , $date)
                         ->orderBy('start_time')
                         ->get();
        }else
        {
            $tasks =[];
        }

        $employee = User::findOrFail($id);

        return view('admin.employee.showOne' , ['tasks' => $tasks , 'employee' => $employee]);


    }
}
