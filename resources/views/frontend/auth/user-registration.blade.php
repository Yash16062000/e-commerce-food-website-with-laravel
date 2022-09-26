@extends('frontend.app')
@section('title','| Registration Page ')

@section('main')

<div class="container pt-5">
  <h2>Registration</h2>
    @if(Session::has('error'))
      <p class="text-danger">{{ Session::get('error') }}</p>
    @endif 
    @if(Session::has('success'))
      <p class="text-success">{{ Session::get('success') }}</p>
    @endif      
  <div class="row">
    <div class="col-sm-4">
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
      <form action="{{route('addUser')}}" method="post">
        @csrf
        <label for="username">Username</label>
        <input type="text" name="name" class="form-control" /><br>
        @if($errors->has('name'))
          <p class="text-danger">{{ $errors->first('name')}}</p>
        @endif
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" /><br>
        @if($errors->has('email'))
          <p class="text-danger">{{ $errors->first('email')}}</p>
        @endif
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" /><br>
        @if($errors->has('password'))
          <p class="text-danger">{{ $errors->first('password')}}</p>
        @endif
        <label for="password">Confirm Password</label>
        <input type="password" name="password_confirmation" class="form-control" /><br>
        @if($errors->has('password'))
          <p class="text-danger">{{ $errors->first('password')}}</p>
        @endif
        <input type="hidden" value="2" name="user_type" class="form-control" /><br>
        
        <button type="reset" class="btn btn-danger mt-4">Reset</button>
        <button type="submit" class="btn btn-info mt-4">Register</button>
        Or
        <a href="{{ route('login_user') }}" class="btn btn-info mt-4">Login</a>
      </form>
    </div>
  </div>
</div>

@endsection