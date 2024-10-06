@extends('admin.layout.main')

@section('content') <!-- بداية قسم المحتوى -->
<div class="create-user-container">
    <h1 class="title">Update User</h1>

    <form action="{{route('user.update' , $user->id)}}" method="POST" class="user-form">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="name"><i class="fas fa-user"></i> Name:</label>
            <input type="text" id="name" value="{{ $user->name }}" name="name" class="form-control" placeholder="Enter full name" required>
            @error('name')
            <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email"><i class="fas fa-envelope"></i> Email:</label>
            <input type="email" id="email" value="{{ $user->email }}" name="email" class="form-control" placeholder="Enter email address" required>
            @error('email')
            <span class="error-message">{{ $message }}</span>
            @enderror
        </div>


        <div class="form-group">
            <label for="password"><i class="fas fa-lock"></i> Password:</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Enter password">
            @error('password')
            <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="role"><i class="fas fa-user-tag"></i> Role:</label>
            <select id="role" name="user_type" class="form-control" required>
                <option value="employee" @if ( $user->user_type == "employee") selected @endif >Employee</option>
                <option value="manager" @if ( $user->user_type == "manager") selected @endif  >Moderator</option>
            </select>
            @error('user_type')
            <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-submit"><i class="fas fa-user-plus"></i> Update User</button>
        </div>
    </form>
</div>
@endsection
