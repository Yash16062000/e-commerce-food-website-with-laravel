@extends('frontend.app')

@section('main')

@if(session()->has('success'))
  <div class="alert alert-info" role="alert"><strong>{{ session()->get('success') }}</strong></div>
  @endif  
<!-- <h1>Home : {{ Auth::user()->name}}</h1> -->

@endsection