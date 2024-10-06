@extends('admin.layout.main')

@section('content')
<section class="content">
    <!-- Welcome Section -->
    <div class="welcome-section">
        <h1>{{ __('message.welcome') }}</h1>
        <p>{{ __('message.manage') }}</p>
    </div>

    <!-- Statistics Section -->
    <div class="statistics">

            <div class="stat-box">
                <h3>{{ $employees }}</h3>
                <a href="{{ route('employee.show') }}"><p>{{ __('message.employees') }}</p></a>
            </div>

            <div class="stat-box">
                <h3>{{ $managers }}</h3>
                <a href="{{ route('manager.show') }}"><p>{{ __("message.managers") }}</p></a>
            </div>


    </div>
</section>
@endsection
