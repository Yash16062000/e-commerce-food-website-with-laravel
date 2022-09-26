<!DOCTYPE html>
<html lang="en">
<head>
  @include('frontend/_head')
  @include('frontend/_css')
</head>
<body>
@include('frontend/_nav')
<div>
@yield('main')
</div>
<br>
@include('frontend/_footer')
@include('frontend/_script')

@yield('script')


</body>
</html> 