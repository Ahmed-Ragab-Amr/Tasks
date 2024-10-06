@extends('admin.layout.main')

@section('content')

<div class="completed-tasks-container">
    <h1>{{ __('message.employees') }}</h1>
    <table class="tasks-table">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('message.name') }}</th>
                <th>{{ __('message.email') }}</th>
                <th>{{ __('message.action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $index => $employee)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td><a href="{{ route('admin.employee' , $employee->id) }}">{{ $employee->name }}</a></td>
                <td>{{ $employee->email }}</td>
                <td>
                    <a href="{{ route('user.edit', $employee->id) }}" class="btn-edit">{{__('message.edit')}}</a>
                    <form action="{{ route('user.delete', $employee->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">{{ __('message.delete') }}</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
