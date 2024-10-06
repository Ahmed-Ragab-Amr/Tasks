<?php

namespace App\Http\Controllers\manager;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ManagerController extends Controller
{
    public function home()
    {
        $waitings = Task::where('status' , 'waiting')->count();
        $ongoings = Task::where('status' , 'ongoing')->count();
        $completes = Task::where('status' , 'completed')->count();
        $cancele = Task::where('status' , 'canceled')->count();
        return view('manager.dashboard' , ['ongoings'=>$ongoings , 'completes'=>$completes , 'cancele'=>$cancele , 'waitings'=>$waitings]);
    }

    public function show()
    {
        $managers = User::where('user_type' , 'manager')->get();
        return view('admin.manager.show' , ['managers'=>$managers]);
    }
}
