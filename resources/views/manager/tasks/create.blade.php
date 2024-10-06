@extends('manager.layout.main')

@section('content')

<div class="create-task-container">
    <h1>{{ __('message.add_task') }}</h1>


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


    <form action="{{ route('task.store') }}" method="POST" class="task-form">
        @csrf
        <div class="form-group">
            <label for="task-team">{{ __('message.task_address') }}</label>
            <input type="text" id="task-team" name="task_address" required>
        </div>

        <div class="form-group">
            <label for="task-title">{{ __('message.phone') }}</label>
            <input type="text" id="task-title" name="task_phone" required>
        </div>

        <div class="form-group">
            <label for="task-phone">{{ __('message.start') }}</label>
            <input type="datetime-local" id="task-phone" name="start_time" required>
        </div>

        <div class="form-group">
            <label for="start-time">{{ __('message.task_work') }}</label>
            <input type="text" id="start-time" name="works" required>
        </div>

        <div class="form-group">
            <label for="task-status">{{ __('message.employee') }}</label>
            <select id="task-status" name="user_id" required>
                    <option></option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="task-status">{{ __('message.group') }}</label>
            <select id="task-status" name="group" required>
                    <option></option>
                    <option value="group1">Group1</option>
                    <option value="group2">Group2</option>
            </select>
        </div>

        <button type="submit" class="btn-submit">{{ __('message.add_task') }}</button>
    </form>
</div>

@endsection
