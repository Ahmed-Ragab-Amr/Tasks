<!DOCTYPE html>
<html lang="{{ session('locale') == 'ar' ? 'ar' : 'en' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/app2.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>
    <div class="main-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo">
                <h2>{{ __('message.task_manager') }}</h2>
            </div>
            <nav>
                <ul>
                    <li><a href="{{ route('employee.dashboard') }}"><i class="fas fa-tasks"></i>{{ __('message.tasks') }}</a></li>
                    <li><a href="{{ route('changelang' , 'ar') }}"><i class="fas fa-tasks"></i> {{ __('message.arabic') }}</a></li>
                    <li><a href="{{ route('changelang' , 'en') }}"><i class="fas fa-tasks"></i> {{ __('message.english') }}</a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button style="background: transparent;color:white; padding:10px;" type="submit"><i class="fas fa-sign-out-alt"></i>{{ __('message.logout') }}</button>
                        </form>
                    </li>
                </ul>
            </nav>
        </aside>
        <div class="completed-tasks-container">
            <h1>{{ __('message.tasks') }}</h1>

            <!-- Tasks for Today -->
            <h2>{{ __('message.task_today') }}</h2>
            <table class="tasks-table">
                <thead>
                    <tr>
                        <th>{{ __('message.task_number') }}</th>
                        <th>{{ __('message.task_address') }}</th>
                        <th>{{ __('message.group') }}</th>
                        <th>{{ __('message.start') }}</th>
                        <th>{{ __('message.phone') }}</th>
                        <th>{{ __('message.task_work') }}</th>
                        <th>{{ __('message.start_task') }}</th>
                        <th>{{ __('message.finish_task') }}</th>
                        <th>{{ __('message.cancel_task') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        @if(\Carbon\Carbon::parse($task->start_time)->isToday())
                        <tr>
                            <td>{{ $task->id }}</td>
                            <td>{{ $task->task_address }}</td>
                            <td>{{ $task->group }}</td>
                            <td>{{ \Carbon\Carbon::parse($task->start_time)->format('d M Y, h:i:s A') }}</td>
                            <td>{{ $task->task_phone }}</td>
                            <td>{{ $task->works }}</td>

                            <!-- Start Task -->
                            <td>
                                @if(!$task->start && !$task->cancele)
                                <form action="{{ route('task.start' , $task->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-square btn-success" style="padding:40px; border:none">{{ __('message.star') }}</button>
                                </form>
                                @elseif ($task->start && !$task->cancele)
                                <button class="btn-square btn-secondary" style="padding:40px; border:none" disabled>{{ __('message.started') }}</button>
                                <div class="task-info">
                                    <h2>{{ __('message.started_at') }}</h2>
                                    <p>{{ \Carbon\Carbon::parse($task->start)->format('d M Y, h:i:s A')}}</p>
                                </div>
                                @endif
                            </td>

                            <!-- Finish Task -->
                            <td>
                                @if($task->start && !$task->end && !$task->cancele)
                                <form action="{{ route('task.end' , $task->id) }}" method="POST">
                                    @csrf
                                    <input type="text" name="price" style="width: 100px; height: 100px; text-align: center; border-radius: 5px;">
                                    <button type="submit" class="btn-square btn-primary" style="padding:40px; border:none">{{ __('message.Finish') }}</button>
                                </form>
                                @elseif($task->end && !$task->canceled)
                                <button class="btn-square btn-secondary" style="padding:40px; border:none" disabled>{{ __('message.finished') }}</button>
                                <div class="task-info">
                                    <h2>{{ __('message.finished_at') }}</h2>
                                    <p>{{ \Carbon\Carbon::parse($task->end)->format('d M Y, h:i:s A') }}</p>
                                </div>
                                @endif
                            </td>

                            <!-- Cancel Task -->
                            <td>
                                @if(!$task->end && !$task->cancele)
                                <form action="{{ route('task.cancele' , $task->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-square btn-danger" style="padding:40px; border:none">{{ __('message.cancel') }}</button>
                                </form>
                                @elseif($task->cancele)
                                <button class="btn-square btn-secondary" style="padding:40px; border:none" disabled>{{ __('message.canceled') }}</button>
                                <div class="task-info">
                                    <h2>{{ __('message.canceled-at') }}</h2>
                                    <p>{{ \Carbon\Carbon::parse($task->cancele)->format('d M Y, h:i:s A') }}</p>
                                </div>
                                @endif
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>

            <!-- Tasks for Tomorrow -->
            <h2>{{ __('message.task_tomorrow') }}</h2>
            <table class="tasks-table">
                <thead>
                    <tr>
                        <th>{{ __('message.task_number') }}</th>
                        <th>{{ __('message.task_address') }}</th>
                        <th>{{ __('message.group') }}</th>
                        <th>{{ __('message.start') }}</th>
                        <th>{{ __('message.phone') }}</th>
                        <th>{{ __('message.task_work') }}</th>
                        <th>{{ __('message.start_task') }}</th>
                        <th>{{ __('message.finish_task') }}</th>
                        <th>{{ __('message.cancel_task') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        @if(\Carbon\Carbon::parse($task->start_time)->isTomorrow())
                        <tr>
                            <td>{{ $task->id }}</td>
                            <td>{{ $task->task_address }}</td>
                            <td>{{ $task->group }}</td>
                            <td>{{ \Carbon\Carbon::parse($task->start_time)->format('d M Y, h:i:s A') }}</td>
                            <td>{{ $task->task_phone }}</td>
                            <td>{{ $task->works }}</td>

                            <!-- Start Task -->
                            <td>
                                @if(!$task->start && !$task->cancele)
                                <form action="{{ route('task.start' , $task->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-square btn-success" style="padding:40px; border:none">{{ __('message.star') }}</button>
                                </form>
                                @elseif ($task->start && !$task->cancele)
                                <button class="btn-square btn-secondary" style="padding:40px; border:none" disabled>{{ __('message.started') }}</button>
                                <div class="task-info">
                                    <h2>{{ __('message.started_at') }}</h2>
                                    <p>{{ \Carbon\Carbon::parse($task->start)->format('d M Y, h:i:s A')}}</p>
                                </div>
                                @endif
                            </td>

                            <!-- Finish Task -->
                            <td>
                                @if($task->start && !$task->end && !$task->cancele)
                                <form action="{{ route('task.end' , $task->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-square btn-primary" style="padding:40px; border:none">{{ __('message.Finish') }}</button>
                                </form>
                                @elseif($task->end && !$task->canceled)
                                <button class="btn-square btn-secondary" style="padding:40px; border:none" disabled>{{ __('message.finished') }}</button>
                                <div class="task-info">
                                    <h2>{{ __('message.finished_at') }}</h2>
                                    <p>{{ \Carbon\Carbon::parse($task->end)->format('d M Y, h:i:s A') }}</p>
                                </div>
                                @endif
                            </td>

                            <!-- Cancel Task -->
                            <td>
                                @if(!$task->end && !$task->cancele)
                                <form action="{{ route('task.cancele' , $task->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-square btn-danger" style="padding:40px; border:none">{{ __('message.cancel') }}</button>
                                </form>
                                @elseif($task->cancele)
                                <button class="btn-square btn-secondary" style="padding:40px; border:none" disabled>{{ __('message.canceled') }}</button>
                                <div class="task-info">
                                    <h2>{{ __('message.canceled_at') }}</h2>
                                    <p>{{ \Carbon\Carbon::parse($task->cancele)->format('d M Y, h:i:s A') }}</p>
                                </div>
                                @endif
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>

        <audio id="notificationSound">
            <source src="{{ asset('notifi.wav') }}" type="audio/mpeg">
        </audio>



        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>


            function checkForNewTasks() {
                var lastTaskId = {{ \App\Models\Task::latest()->first()->id ?? 0 }};
                $.ajax({
                    url: '{{ route("check.new.tasks") }}',
                    method: 'GET',
                    data: { lastTaskId: lastTaskId },
                    success: function(response) {
                        if (response.newTasks && response.newTasks.length > 0) {

                            var sound = document.getElementById("notificationSound");
                            sound.play();

                                setTimeout(function() {
                                    location.reload();
                                }, 3000);

                        }
                    },
                    error: function() {
                        console.log('Error checking for new tasks');
                    }
                });
            }

            setInterval(checkForNewTasks, 10000); // تكرار العملية كل 10 ثوانٍ
        </script>





    </div>
</body>
</html>
