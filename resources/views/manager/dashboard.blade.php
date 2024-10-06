@extends('manager.layout.main')

@section('content')

<section class="content">
    <!-- Welcome Section -->
    <div class="welcome-section">
        <h1>{{ __('message.welcome') }}</h1>
        <p>{{ __('message.manage_task') }}</p>
    </div>

    <!-- Statistics Section -->
    <div class="statistics">

            <div class="stat-box">
                <h3>{{ $waitings }}</h3>
                <a href="{{ route('task.waiting') }}"><p>{{ __('message.waiting') }}</p></a>
            </div>


            <div class="stat-box">
                <h3>{{ $ongoings }}</h3>
                <a href="{{ route('task.ongoing') }}"> <p>{{ __('message.ongoing') }}</p>  </a>
            </div>


            <div class="stat-box">
                <h3>{{ $completes }}</h3>
                <a href="{{ route('task.completed') }}"> <p>{{ __('message.complete') }}</p></a>
            </div>


            <div class="stat-box">
                <h3>{{ $cancele }}</h3>
                <a href="{{ route('task.canceled') }}">  <p>{{ __('message.canceled_task') }}</p> </a>
            </div>

    </div>
</section>

@endsection
