<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | sunkub</title>
    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <div class="bg-zinc-500 flex">
        <div class="flex">
            <div class="bg-neutral-800 drop-shadow-lg">
                <div class="flex items-center">
                    <img src="{{url('images/LOGO.svg')}}" alt="" class="mb-4 ml-5 p-4 pl-3 pb-12 pr-16"></img>
                </div>
                    <ul class="space-y-5">
                        <li class="flex items-center text-white hover:bg-zinc-500 px-3 py-4 block">  
                            <img src="https://via.placeholder.com/24x24" alt="" class="mr-5 pl-4"></img>
                            <a href="#">การเทรดหุ้น</a>
                        </li>
                        <li class="flex items-center text-white hover:bg-zinc-500 px-3 py-4 block">  
                            <img src="https://via.placeholder.com/24x24" alt="" class="mr-5 pl-4"></img>
                            <a href="#">แดชบอร์ด</a>
                        </li>
                        <li class="flex items-center text-white hover:bg-zinc-500 px-3 py-4 block">  
                            <img src="https://via.placeholder.com/24x24" alt="" class="mr-5 pl-4"></img>
                            <a href="#">พอร์ตของฉัน</a>
                        </li>
                        <li class="flex items-center text-white hover:bg-zinc-500 px-3 py-4 block">  
                            <img src="https://via.placeholder.com/24x24" alt="" class="mr-5 pl-4"></img>
                            <a href="#">ประวัติการซื้อขาย</a>
                        </li>
                        <li class="flex items-center text-white hover:bg-zinc-500 px-3 py-4 block">  
                            <img src="https://via.placeholder.com/24x24" alt="" class="mr-5 pl-4"></img>
                            <a href="#">รายการหุ้นที่สนใจ</a>
                        </li>
                        <li class="flex items-center text-white hover:bg-zinc-500 px-3 py-4 block">  
                            <img src="https://via.placeholder.com/24x24" alt="" class="mr-5 pl-4"></img>
                            <a href="#">กระเป๋าตังค์</a>
                        </li>
                    </ul>
            </div>
        </div>

        <div class="flex-1 h-full">
            <div class="navbar bg-zinc-800 text-white flex justify-between  pl-5 pr-5">
                <div>@yield('contentnav')</div>
                <div class="flex">
                    <ul class="menu menu-horizontal px-1">
                        <li class="white200">
                            <details>
                                <summary>
                                    test
                                </summary>
                                <ul class="p-2 bg-purple-600 rounded-t-none">
                                    <li class="purple200">
                                        <a class="purple200 underline-offset-0" href="/loginport">สลับบัญชี</a>
                                    </li>
                                    <li class="purple200">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <a  class="white200 underline-offset-0" href="route('logout')"
                                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                                {{ __('Log Out') }}
                                            </a>
                                        </form>
                                    </li>
                                </ul>
                            </details>
                        </li>
                    </ul>
                </div>
            </div>
            @yield('content')
        </div>
    </div>
</body>
</html>