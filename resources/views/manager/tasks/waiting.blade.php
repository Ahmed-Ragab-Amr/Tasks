@extends('manager.layout.main')

@section('content')

<div class="completed-tasks-container">
    <h1>{{ __('message.waiting') }}</h1>
    <table class="tasks-table">
        <thead>
            <tr>
                <th>{{ __('message.task_number') }}</th>
                <th>{{ __('message.task_work') }}</th>
                <th>{{ __('message.employee') }}</th>
                <th>{{ __('message.phone') }}</th>
                <th>{{ __('message.task_address') }}</th>
                <th>{{ __('message.start') }}</th>
                <th>{{ __('message.action') }}</th>
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
                        <td colspan="7" style="text-align:center; background-color: #f0f0f0; font-weight: bold;">
                            {{ $task->user->name }}'s Tasks
                        </td>
                    </tr>
                @endif

            <tr>
                <td>{{ $task->id }}</td>
                <td>{{ $task->works }}</td>
                <td>{{ $task->user->name }}</td>
                <td>{{ $task->task_phone }}</td>
                <td>{{ $task->task_address }}</td>
                <td>{{ $task->start_time }}</td>
                <td>
                    <a href="{{ route('task.edit' , $task->id) }}" class="btn-edit">{{ __('message.edit') }}</a>
                    <form action="{{ route('task.cancele' , $task->id) }}" method="post">
                        @csrf
                        <button type="submit" class="btn-delete">{{ __('message.cancel') }}</button>
                    </form>
                </td>
            </tr>
            @endforeach

            <!-- Add more completed tasks as needed -->
        </tbody>
    </table>
</div>

<script>
    setTimeout(function(){
        location.reload();
    }, 30000);
</script>

@endsection
