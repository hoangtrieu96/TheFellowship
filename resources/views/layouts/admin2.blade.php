<!DOCTYPE html>
<html>
  <head>
    @yield('title')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  </head>
  <body>

    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="d-flex flex-row">
          <ul class="nav navbar-nav">
            <li class="p-3 m-2"><a href="{{ URL::to('home') }}">Home</a></li>
            <li class="p-3 m-2"><a href="{{ URL::to('categories') }}">Categories</a></li>
            <li class="p-3 m-2"><a href="{{ URL::to('forums') }}">Forums</a></li>
            <li class="p-3 m-2"><a href="{{ URL::to('topics') }}">Topics</a></li>
            <li class="p-3 m-2"><a href="{{ URL::to('comments') }}">Comments</a></li>
            <li class="p-3 m-2"><a href="{{ URL::to('users') }}">Users</a></li>
          </ul>
        </div>
      </nav>

      @yield('heading')

      <br/>

      @if (Session::has('message'))
        <div class="alert alert-info">
          {{ Session::get('message') }}
        </div>
      @endif

      <br/>

      @yield('content')
    </div>
  </body>
</html>
