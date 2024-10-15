<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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


                    <li><a href="{{ route('admin.dashborad')}}"><i class="fas fa-home"></i>{{__('message.dashboard')}}</a></li>
                    <li><a href="{{route('user.create')}}"><i class="fas fa-plus-circle"></i> {{ __('message.add_user') }}</a></li>
                    <li><a href="{{ route('employee.show') }}"><i class="fas fa-tasks"></i>{{ __('message.view_employee') }}</a></li>
                    <li><a href="{{ route('manager.show') }}"><i class="fas fa-tasks"></i> {{ __('message.view_moderator') }}</a></li>
                    <li><a href="{{ route('showPrice') }}"><i class="fas fa-tasks"></i> {{ __('message.show_price') }}</a></li>
                    <li><a href="{{ route('changelang' , 'ar') }}"><i class="fas fa-tasks"></i> {{ __('message.arabic') }}</a></li>
                    <li><a href="{{ route('changelang' , 'en') }}"><i class="fas fa-tasks"></i> {{ __('message.english') }}</a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button style="background: transparent;color:white; padding:10px;" type="submit"><i class="fas fa-sign-out-alt"></i>{{ __('message.logout') }}</button>
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
