@extends('manager.layout.main')

@section('content')

<div class="completed-tasks-container">
    <h1>{{ __('message.ongoing') }}</h1>
    <table class="tasks-table">
        <thead>
            <tr>
                <th>{{ __('message.task_number') }}</th>
                <th>{{ __('message.task_work') }}</th>
                <th>{{ __('message.employee') }}</th>
                <th>{{ __('message.phone') }}</th>
                <th>{{ __('message.task_address') }}</th>
                <th>{{ __('message.started_at') }}</th>
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
                        <td colspan="6" style="text-align:center; background-color: #f0f0f0; font-weight: bold;">
                            {{ $task->user->name }}'s Tasks
                        </td>
                    </tr>
                @endif
            <tr>
                <td>1</td>
                <td>{{ $task->works }}</td>
                <td>{{ $task->user->name }}</td>
                <td>{{ $task->task_phone }}</td>
                <td>{{ $task->task_address }}</td>
                <td>{{ $task->start }}</td>
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
