<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>@yield('title') | HIMASI UNUSA</title>
  <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">

  @stack('prepend-style')
  @include('includes.admin.style')
  @stack('addon-style')

  
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      
      @include('includes.admin.navbar');
      
      @include('includes.admin.sidebar');

      @yield('content')
          
      @include('includes.admin.footer')
    </div>
  </div>

  @stack('prepend-script')
  @include('sweetalert::alert')
  @include('includes.admin.script')
  @stack('addon-script')
</body>
</html>
