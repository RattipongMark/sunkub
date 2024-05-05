<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | sunkub</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="/css/navbar.css">
    @yield('css')
    <link href='https://fonts.googleapis.com/css?family=Kanit' rel='stylesheet'>
    <style>
      body {
          font-family: 'Kanit';
      }
      </style>
</head>
<body>
    <div class="navbar bg-base-100 navblur">
        <div class="flex-1">
          <a class="btn btn-ghost text-xl"><img src="{{url('images/LOGO.svg')}}" alt=""></a>
        </div>
        <div class="flex-none">
          <ul class="menu menu-horizontal px-1">
            <li class="purple200"><a href="/login">เข้าสู่ระบบ</a></li>
            <li class="white200"><a href="/register">ลงทะเบียน</a></li>
          </ul>
        </div>
    </div>

    <div>
        @yield('content')
    </div>
</body>
</html>