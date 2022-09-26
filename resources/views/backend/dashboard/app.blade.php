<!DOCTYPE html>
<html lang="en">
<head>
  @include('backend/dashboard/_head')
  @include('backend/dashboard/_style')
</head>
<body class="cbp-spmenu-push">
<div class="main-content">
@include('backend/dashboard/_nav')
@yield('main')
@include('backend/dashboard/_script')


@include('backend/dashboard/_footer')
</div>


@yield('script')



</body>
</html> 