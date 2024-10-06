@extends('admin.layout.main')

@section('content')

<div class="completed-tasks-container">
    <h1> {{ $employee->name }}</h1>

    <!-- Form to select date and fetch tasks -->
    <form action="{{ route('admin.tasks' , $employee->id) }}" method="GET">
        <label for="task-date">{{ __('message.chose_date') }}</label>
        <input type="date" name="date" id="task-date" onchange="this.form.submit()">
    </form>

    @if(isset($tasks) && count($tasks) > 0)
        <table class="tasks-table">
            <thead>
                <tr>
                    <th>{{ __('message.task_number') }}</th>
                    <th>{{ __('message.task_address') }}</th>
                    <th>{{ __('message.start') }}</th>
                    <th>{{ __('phone') }}</th>
                    <th>{{ __('message.task_work') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->task_address }}</td>
                    <td>{{ \Carbon\Carbon::parse($task->start_time)->format('d M Y, h:i:s A') }}</td>
                    <td>{{ $task->task_phone }}</td>
                    <td>{{ $task->works }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No tasks found for this date.</p>
    @endif
</div>

@endsection
