<?php

namespace App\Http\Controllers\employee;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{
    public function home()
    {
        $tasks = Task::where('user_id', auth()->user()->id)
                      ->orderBy('start_time', 'asc')
                      ->get();

            return view('employee.dashboard', ['tasks' => $tasks]);
    }

    public function show()
    {
        $employees = User::where('user_type' , 'employee')->get();
        return view('admin.employee.show' , ['employees' => $employees]);
    }

}
