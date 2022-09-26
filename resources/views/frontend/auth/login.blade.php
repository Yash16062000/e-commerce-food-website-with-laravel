@extends('frontend.app')
@section('title','| Login Page ')
@section('main')

<div class="container pt-5">
  <h2>Login</h2> 
  @if(session()->has('error'))
  <div class="alert alert-danger" role="alert"><strong>{{ session()->get('error') }}</strong></div>
  @endif   
  <!-- @if(Session::has('success'))
  <div class="alert alert-info" role="alert"><strong>{{ Session::get('success')}}</strong></div>
  @endif          -->
  <div class="row">
    <div class="col-sm-4">
      <form action="/user-login" method="post">
        @csrf
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" /><br>
        @if($errors->has('email'))
          <p class="text-danger">{{ $errors->first('email')}}</p>
        @endif
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control"/><br>
        @if($errors->has('password'))
          <p class="text-danger">{{ $errors->first('password')}}</p>
        @endif
        <input type="submit" class="btn btn-info mt-4" value="Login">
        <div class="row">
          <div class="col-8 text-left">
          <a href="" class="btn btn-link">Forgot Password?</a>or<a href="/user-registration" class="btn btn-link">New User</a>
          </div>
         
        
        </div>
        
        
        
      </form>
    </div>
  </div>
</div>

@endsection