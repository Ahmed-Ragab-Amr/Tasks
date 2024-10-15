@extends('manager.layout.main')

@section('content')

<div class="completed-tasks-container">
    <h1>{{ __('message.tasks') }}</h1>

    <!-- Form to select date and fetch tasks -->
    <form action="{{ route('manager.gettasks') }}" method="GET">
        <label for="task-date">{{ __('message.chose_date') }}</label>
        <input type="date" name="date" id="task-date" onchange="this.form.submit()">
    </form>

    @if(isset($tasks) && count($tasks) > 0)
        <table class="tasks-table">
            <thead>
                <tr>
                    <th>{{ __('message.task_number') }}</th>
                    <th>{{ __('message.employee') }}</th>
                    <th>{{ __('message.task_address') }}</th>
                    <th>{{ __('message.group') }}</th>
                    <th>{{ __('message.start') }}</th>
                    <th>{{ __('message.phone') }}</th>
                    <th>{{ __('message.task_work') }}</th>
                    <th>{{ __('message.finished_at') }}</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $currentUser = null;
                @endphp

                @foreach ($tasks as $task)
                    @if ($currentUser !== $task->user->id)
                        @php
                            $currentUser = $task->user->id;
                        @endphp
                        <tr class="user-separator">
                            <td colspan="8" style="text-align:center; background-color: #f0f0f0; font-weight: bold;">
                                {{ $task->user->name }}'s Tasks
                            </td>
                        </tr>
                    @endif

                    <tr @if($task->status == 'canceled') style="background: red" @endif>
                        <td>{{ $task->id }}</td>
                        <td>{{ $task->user->name }}</td>
                        <td>{{ $task->task_address }}</td>
                        <td>{{ $task->group }}</td>
                        <td>{{ \Carbon\Carbon::parse($task->start_time)->format('d M Y, h:i:s A') }}</td>
                        <td>{{ $task->task_phone }}</td>
                        <td>{{ $task->works }}</td>
                        @if ($task->price != NULL)
                        <td>{{ $task->end }} price: <strong>{{ $task->price }}</strong></td>
                        @else
                            <td>{{ $task->end }} price: <strong>NULL</strong></td>
                        @endif
                    </tr>

                @endforeach
            </tbody>
        </table>
    @else
        <p>{{ __('message.no task') }}</p>
    @endif
</div>

@endsection
