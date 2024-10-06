@extends('manager.layout.main')

@section('content')

<div class="create-task-container">
    <h1>Update Task</h1>

    @if(session('warning'))
    <div class="alert alert-warning">
        <p>{{ session('warning') }}</p>
        <form action="{{ route('task.store') }}" method="POST">
            @csrf
            @foreach (session('taskData') as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach
            <input type="hidden" name="confirm" value="1">
            <button type="submit" class="btn-submit">Proceed Anyway</button>
            <br>
            <br>
            <br>
            <a href="{{ url()->previous() }}" ><button class="btn-submit">Cancel </button></a>
        </form>
    </div>
@endif

    <form action="{{ route('task.update' , $task->id) }}" method="POST" class="task-form">
        @csrf
        <div class="form-group">
            <label for="task-team">Task Address</label>
            <input type="text" value="{{ $task->task_address }}" id="task-team" name="task_address" required>
        </div>

        <div class="form-group">
            <label for="task-title">Task Phone</label>
            <input type="text" value="{{ $task->task_phone }}" id="task-title" name="task_phone" required>
        </div>


        <div class="form-group">
            <label for="task-phone">Start Time</label>
            <input type="datetime-local" value="{{ $task->start_time }}" id="task-phone" name="start_time" required>
        </div>

        <div class="form-group">
            <label for="start-time">Works</label>
            <input type="text" value="{{ $task->works }}" id="start-time" name="works" required>
        </div>

        <div class="form-group">
            <label for="task-status">Employee</label>
            <select id="task-status" name="user_id" required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" @if($task->user_id == $user->id) selected @endif>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="task-status">Group</label>
            <select id="task-status" name="group" required>
                    <option value="group1" @if($task->group == 'group1') selected @endif>group1</option>
                    <option value="group2" @if($task->group == 'group2') selected @endif>group2</option>
            </select>
        </div>

        <button type="submit" class="btn-submit">Update Task</button>
    </form>
</div>

@endsection
