<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moderator Dashboard</title>
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
                    <li><a href="{{ route('manager.dashboard')}}"><i class="fas fa-home"></i> {{ __('message.dashboard') }}</a></li>
                    <li><a href="{{ route('manager.tasks')}}"><i class="fas fa-home"></i>{{ __('message.show_task') }}</a></li>
                    <li><a href="{{route('task.create')}}"><i class="fas fa-plus-circle"></i>{{ __('message.add_task') }}</a></li>
                    <li><a href="{{ route('task.waiting') }}"><i class="fas fa-tasks"></i>{{ __('message.waiting') }}</a></li>
                    <li><a href="{{ route('task.ongoing') }}"><i class="fas fa-tasks"></i> {{ __('message.ongoing') }}</a></li>
                    <li><a href="{{ route('task.completed') }}"><i class="fas fa-check-circle"></i> {{ __('message.complete') }}</a></li>
                    <li><a href="{{ route('task.canceled') }}"><i class="fas fa-times-circle"></i> {{ __('message.canceled_task') }}</a></li>
                    <li><a href="{{ route('changelang' , 'ar') }}"><i class="fas fa-tasks"></i> {{ __('message.arabic') }}</a></li>
                    <li><a href="{{ route('changelang' , 'en') }}"><i class="fas fa-tasks"></i> {{ __('message.english') }}</a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button style="background: transparent;color:white; padding:10px;" type="submit"><i class="fas fa-sign-out-alt"></i> {{ __('message.logout') }}</button>
                        </form>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        @yield('content')
    </div>
</body>
</html>
