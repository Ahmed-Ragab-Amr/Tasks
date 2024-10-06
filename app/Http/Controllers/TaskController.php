<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class TaskController extends Controller
{
    public function create()
    {
        $users  = User::where('user_type' , 'employee')->get();
        return view('manager.tasks.create' , ['users'=>$users]);
    }
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $users  = User::where('user_type' , 'employee')->get();
        return view('manager.tasks.edit' , ['task'=>$task , 'users'=>$users]);
    }

    public function store(Request $request)
    {

        $existingTask = Task::whereDate('start_time', \Carbon\Carbon::parse($request->start_time)->format('Y-m-d'))
                            ->whereTime('start_time', \Carbon\Carbon::parse($request->start_time)->format('H:i:s'))
                            ->where('user_id' , $request->user_id)
                            ->first();

        if ($existingTask && !$request->has('confirm')) {
            return back()->with([
                'warning' => 'This time is already taken. Do you want to proceed anyway?',
                'taskData' => $request->all()
            ]);
        }

        $data = $request->except('task_phone');

        $request->validate([
            'task_address'=>'required|string',
            'start_time'=>'required|date',
            'task_phone'=>'required|string',
            'works'=>'required|string',
            'user_id'=>"required",
            'group'=>"required",
        ]);

        $task_phone = '+965' . $request->task_phone;

        $data['task_phone'] = $task_phone;



        $task = Task::create($data);

        $this->sendWhatsAppMessage($task);

        return redirect()->route('task.waiting')->with('success', 'Task created successfully');;
    }


 private function sendWhatsAppMessage($task)
{
    $taskLink = url('/show/task/' . $task->uuid);

    $arrContextOptions = array(
        "ssl" => array(
            "verify_peer" => false,
            "verify_peer_name" => false,
        ),
    );

    $number = $task->task_phone;
   $message = urlencode("تم تأكيد حجزك عزيزتي لخدمة الهوم سيرفس لتعديل الحجز يرجى التواصل على رقم 69089893 ");
    $url = "http://37.34.230.93/bot2/send_message/WwAgKsorO2?number=$number&image_url=$message&is_text=1";

    try {
        $response = file_get_contents($url, false, stream_context_create($arrContextOptions));

        if ($response && strpos($response, "sent") !== false) {
            return true;
        } else {

            error_log("WhatsApp API Error: " . $response);
            return false;
        }
    } catch (\Exception $e) {
        error_log("WhatsApp API Exception: " . $e->getMessage());
        return false;
    }
}





    public function update(Request $request , $id)
    {
        $task = Task::findOrFail($id);
        $existingTask = Task::where('id' , '!=' , $id)
                            ->whereDate('start_time', \Carbon\Carbon::parse($request->start_time)->format('Y-m-d'))
                            ->whereTime('start_time', \Carbon\Carbon::parse($request->start_time)->format('H:i:s'))
                            ->where('user_id' , $request->user_id)
                            ->first();

        if ($existingTask && !$request->has('confirm')) {
            return back()->with([
                'warning' => 'This time is already taken. Do you want to proceed anyway?',
                'taskData' => $request->all()
            ]);
        }



        $request->validate([
            'task_address'=>'required|string',
            'start_time'=>'required|date',
            'task_phone'=>'required|string',
            'works'=>'required|string',
            'user_id'=>"required",
            'group'=>"required",
        ]);



        $task->update($request->all());
        return redirect()->route('task.waiting')->with('success', 'Task created successfully');;
    }

    public function showWaiting()
    {
        $tasks = Task::where('status' , 'waiting')
                      ->orderBy('user_id')
                      ->orderBy('start_time')
                      ->get();
        return view('manager.tasks.waiting' , ['tasks' => $tasks]);
    }
    public function showOngoing()
    {
        $tasks = Task::where('status' , 'ongoing')
                        ->orderBy('user_id')
                        ->orderBy('start_time')
                        ->get();
        return view('manager.tasks.ongoing' , ['tasks' => $tasks]);
    }

    public function showCompleted()
    {
        $tasks = Task::where('status' , 'completed')
                        ->orderBy('user_id')
                        ->orderBy('start_time')
                        ->get();
        return view('manager.tasks.compelete' , ['tasks' => $tasks]);
    }
    public function showCanceled()
    {
        $tasks = Task::where('status' , 'canceled')
                      ->orderBy('user_id')
                      ->orderBy('start_time')
                      ->get();
        return view('manager.tasks.canceled' , ['tasks' => $tasks]);
    }


    public function start(Request $request , $id)
    {
        $task = Task::findOrFail($id);
        $task->update([
            'start'=>now(),
            'status'=>'ongoing',
        ]);
        return redirect()->back();
    }

    public function end(Request $request , $id)
    {
        $task = Task::findOrFail($id);
        $task->update([
            'end'=>now(),
            'status'=>'completed',
        ]);
        return redirect()->back();
    }

    public function cancel(Request $request , $id)
    {
        $task = Task::findOrFail($id);
        $task->update([
            'cancele'=>now(),
            'status'=>'canceled',
        ]);
        return redirect()->back();
    }



    public function showClientTask($uuid)
    {
        $task = Task::where('uuid', $uuid)->firstOrFail();
        return view('client.showTask' , ['task'=>$task]);
    }

    public function ClientCanceleTask(Request $request , $uuid)
    {
        if ($request->has('cancele')) {
            $task = Task::where('uuid', $uuid)->firstOrFail();
            $task->update([
                'cancele'=>now(),
                'status'=>'canceled',
            ]);

            return back()->with('success', 'تم الغاء الموعد بنجاح.');
        }

        return back()->with('error', 'يرجي اختيار الغاء الموعد');
    }


    public function ShowDateTasks()
    {
        return view('manager.tasks.showAll');
    }

    public function getTasks(Request $request)
    {
        $date = $request->date;

        if($date)
        {
            $tasks = Task::whereDate('start_time' , $date)
                         ->orderBy('user_id')
                         ->orderBy('start_time')
                         ->get();
        }
        else
        {
            $tasks =[];
        }

        return view('manager.tasks.showAll' , ["tasks"=>$tasks]);

    }

}
