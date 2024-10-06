@extends('admin.layout.main')

@section('content') <!-- بداية قسم المحتوى -->
<div class="create-user-container">
    <h1 class="title">{{ __('message.create_new_user') }}</h1>

    <form action="{{route('user.store')}}" method="POST" class="user-form">
        @csrf

        <div class="form-group">
            <label for="name"><i class="fas fa-user"></i>{{ " " }}{{ __('message.name') }}</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="{{ __('message.enter_name') }}" required>
            @error('name')
            <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email"><i class="fas fa-envelope"></i>{{ " " }}{{ __('message.email') }}</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="{{ __("message.enter_email") }}" required>
            @error('email')
            <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

    
        <div class="form-group">
            <label for="password"><i class="fas fa-lock"></i>{{ " " }}{{ __('message.password') }}</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="{{__('message.enter_pass')}}" required>
            @error('password')
            <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="role"><i class="fas fa-user-tag"></i>{{ " " }}{{ __('message.role') }}</label>
            <select id="role" name="user_type" class="form-control" required>
                <option value="employee">{{__('message.employee')}}</option>
                <option value="manager">{{ __('message.manager') }}</option>
            </select>
            @error('user_type')
            <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-submit"><i class="fas fa-user-plus"></i>{{ __('message.add_user') }}</button>
        </div>
    </form>
</div>
@endsection
