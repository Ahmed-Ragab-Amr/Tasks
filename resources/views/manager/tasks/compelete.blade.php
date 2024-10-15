@extends('manager.layout.main')

@section('content')

<div class="completed-tasks-container">
    <h1>{{ __('message.complete') }}</h1>
    <table class="tasks-table">
        <thead>
            <tr>
                <th>{{ __('message.task_number') }}</th>
                <th>{{ __('message.task_work') }}</th>
                <th>{{ __('message.employee') }}</th>
                <th>{{ __('message.phone') }}</th>
                <th>{{ __('message.task_address') }}</th>
                <th>{{ __('message.started_at') }}</th>
                <th>{{ __('message.finished_at') }}</th>
            </tr>
        </thead>
        <tbody>
            @php
            $taskNumber = 1;
            @endphp

            @foreach ($tasks as $userTasks)
                @php
                $currentUser = $userTasks->first()->user;
                @endphp
                <tr class="user-separator">
                    <td colspan="7" style="text-align:center; background-color: #f0f0f0; font-weight: bold;">
                        {{ $currentUser->name }}'s Tasks
                    </td>
                </tr>

                @foreach ($userTasks as $task)
                <tr>
                    <td>{{ $taskNumber++ }}</td>
                    <td>{{ $task->works }}</td>
                    <td>{{ $task->user->name }}</td>
                    <td>{{ $task->task_phone }}</td>
                    <td>{{ $task->task_address }}</td>
                    <td>{{ $task->start }}</td>
                    @if ($task->price != NULL)
                        <td>{{ $task->end }} price: <strong>{{ $task->price }}</strong></td>
                    @else
                        <td>{{ $task->end }} price: <strong>NULL</strong></td>
                    @endif
                </tr>
                @endforeach

            @endforeach
        </tbody>
    </table>
</div>

<script>
    setTimeout(function(){
        location.reload();
    }, 30000);
</script>

@endsection
