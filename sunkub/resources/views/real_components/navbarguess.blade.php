<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | sunkub</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/navbar.css">
    @yield('css')
    <link href='https://fonts.googleapis.com/css?family=Kanit' rel='stylesheet'>
    <style>
        body {
            font-family: 'Kanit';
            background-color: #27272A;
        }
    </style>
</head>

<body onload="activeshowpage()">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
   <script src="{{ asset('/js/all.js') }}"></script>
    <div class="lds-ripple" id="loaditem"><div></div><div></div></div>
    <div id="pagecontent" class="content fadecontent">
        <div class="navbar bg-base-100  navblur">
            <div class="flex-1">
                <a class="btn btn-ghost text-xl"><img src="{{ url('images/LOGO.svg') }}" alt=""></a>
            </div>
            <div class="flex h-8">
                <ul class="menu menu-horizontal px-1 flex items-center pt-4">
                    <li><a class="purple200 underline-offset-0" href="/loginport">เข้าสู่บัญชีเทรด</a></li>
                    <li class="white200">
                        <details>
                            <summary>
                                <div class="flex items-center">
                                    <div class="px-2.5">{{ $user->fname }}</div>
                                    <div><img src="images/UserCircle.svg" alt=""></div>
                                </div>
                            </summary>
                            <ul class="p-2 bg-purple-600 rounded-t-none w-full flex justify-center">
                                <li class="purple200">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a class="white200 underline-offset-0" href="route('logout')"
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

        <div>
            @yield('content')
        </div>
    </div>

    {{-- <script>
        // Function to hide loading animation and show page content
        function showpage(){
            document.getElementById('loaditem').style.display = 'none';
            document.getElementById('pagecontent').style.display = 'block';
        }

        // Function to trigger showpage after a delay
        function activeshowpage() {
            let content = setTimeout(showpage,3000);
        }
    </script> --}}
</body>

</html>
