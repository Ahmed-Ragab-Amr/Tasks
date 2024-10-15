@extends('admin.layout.main')

@section('content')

<div class="completed-tasks-container">
    <h1>{{ __('message.price') }}</h1>

    <!-- Form to select date and fetch tasks -->
    <form action="{{ route('getPrice') }}" method="GET">
        <label for="task-date">{{ __('message.chose_date') }}</label>
        <input type="date" name="date" id="task-date" onchange="this.form.submit()">
    </form>

    @if(isset($tasks) && count($tasks) > 0)
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
                $currentUser = null;
                $previousUser = null;
                $totalPrice = 0;
            @endphp

            @foreach ($tasks as $index=>$task)
                @if ($currentUser !== $task->user->id)
                    @if ($currentUser !== null)
                        <tr>
                            <td colspan="8" style="text-align:right; background-color: #f9f9f9; font-weight: bold;">
                                Total Price for {{ $previousUser }}: <strong>{{ $totalPrice }}</strong>
                            </td>
                        </tr>
                    @endif

                    @php
                        $previousUser = $task->user->name;
                        $currentUser = $task->user->id;
                        $totalPrice = 0;
                    @endphp
                    <tr class="user-separator">
                        <td colspan="8" style="text-align:center; background-color: #f0f0f0; font-weight: bold;">
                            {{ $task->user->name }}'s Tasks
                        </td>
                    </tr>
                @endif

                @php
                    $totalPrice += (int)$task->price ?? 0;
                @endphp

                <tr>
                    <td>{{ $index+1 }}</td>
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

            <!-- عرض إجمالي السعر بعد آخر مستخدم -->
            @if ($currentUser !== null)
                <tr>
                    <td colspan="8" style="text-align:right; background-color: #f9f9f9; font-weight: bold;">
                        Total Price for {{ $previousUser }}: <strong>{{ $totalPrice }}</strong>
                    </td>
                </tr>
            @endif

            </tbody>
        </table>
    @else
        <p>{{ __('message.no task') }}</p>
    @endif
</div>

@endsection
