<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | sunkub</title>
    @vite('resources/css/app.css')
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

        .market-open {
            color: rgb(74 222 128);
        }

        .market-closed {
            color: rgb(248 113 113);
        }
        
    </style>
</head>

<body onload="activeshowpage()">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="{{ asset('/js/all.js') }}"></script>
    <div class="bg-zinc-600 ">
        <div class="flex flex-row relative min-h-screen">
            <div class="sticky bg-neutral-800 drop-shadow-lg basis-1/4 w-full  ">
                <div class="sticky flex flex-col items-center top-0">
                    <img src="{{ url('images/LOGO.svg') }}" alt="" class="p-4">
                    </img>
                    <ul class="space-y-5 w-full">
                        <a href="/trading">
                            <li class="flex items-center text-white hover:bg-zinc-500 px-3 py-4 block ">
                                <img src="{{ url('images/ChartLineUp.svg') }}" alt="" class="mr-5 pl-4"></img>
                                <div>การเทรดหุ้น</div>
                            </li>
                        </a>
                        <a href="/mydashboard">
                            <li class="flex items-center text-white hover:bg-zinc-500 px-3 py-4 block">
                                <img src="{{ url('images/ChartPieSlice.svg') }}" alt="" class="mr-5 pl-4"></img>
                                <div>แดชบอร์ด</div>
                            </li>
                        </a>
                        <a href="/myport">
                            <li class="flex items-center text-white hover:bg-zinc-500 px-3 py-4 block">
                                <img src="{{ url('images/Clipboard.svg') }}" alt="" class="mr-5 pl-4"></img>
                                <div>พอร์ตของฉัน</div>
                            </li>
                        </a>
                        <a href="/history">
                        <li class="flex items-center text-white hover:bg-zinc-500 px-3 py-4 block">
                            <img src="{{ url('images/Clock.svg') }}" alt="" class="mr-5 pl-4"></img>
                            <div>ประวัติการซื้อขาย</div>
                        </li>
                        </a>
                        <a href="/mywallet">
                        <li class="flex items-center text-white hover:bg-zinc-500 px-3 py-4 block">
                            <img src="{{ url('images/Wallet.svg') }}" alt="" class="mr-5 pl-4"></img>
                            <div>กระเป๋าตังค์</div>
                        </li>
                    </a>
                    </ul>
                </div>
            </div>
            <div class="grid w-full h-full">
                <div class="h-full sticky top-0 navpo">
                    <div class="navbar bg-zinc-800 text-white pl-5 pr-5 ">
                        <div>@yield('contentnav')</div>
                        <div>
                            <div class="flex flex-cols px-16 items-center">
                                <div id="market-status" class="text-red-400">Market Close</div>
                                <script>
                                    updateMarketStatus();
                                </script>
                                <div class="mx-2"> : </div>
                                <div class="opacity-50"><iframe scrolling="no" frameborder="no" clocktype="html5"
                                        style="overflow:hidden;border:0;margin:0;padding:0;width:240px;height:25px;"src="https://www.clocklink.com/html5embed.php?clock=018&timezone=GMT0700&color=gray&size=240&Title=&Message=&Target=&From=2024,1,1,0,0,0&DateFormat=dd / mm / yyyy DDD&TimeFormat=hh:mm:ss&Color=gray"></iframe>
                                </div>
                            </div>
                            <div class="dropdown dropdown-end pr-4 ">
                                <div tabindex="0" role="button" class="flex items-center">
                                    <div class="px-2.5">{{ $user->fname }}</div>
                                    <div><img src="images/UserCircle.svg" alt=""></div>
                                </div>

                                <ul tabindex="0"
                                    class="dropdown-content z-[1] menu p-2 shadow bg-violet-950 rounded-box w-36 mt-4">
                                    <li><a class="purple200" href="/loginport">สลับบัญชี</a></li>
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
                            </div>
                        </div>

                    </div>
                </div>
                <div class="h-fit">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</body>

</html>
{{-- 
<div class="flex h-screen fixed">
    <div class="bg-neutral-800 drop-shadow-lg ">
        <div class="flex items-center">
            <img src="{{ url('images/LOGO.svg') }}" alt=""
                class="mb-4 ml-5 p-4 pl-3 pb-12 pr-16"></img>
        </div>
        <ul class="space-y-5 ">
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
<div class="flex-1 w-screen h-full justify-items-end  ">
    <div class="navbar bg-zinc-800 text-white flex justify-between pl-5 pr-5 fixed">
        <div>@yield('contentnav')</div>
        <div class="dropdown dropdown-end pr-4 fixed">
            <div tabindex="0" role="button">test</div>
            <ul tabindex="0"
                class="dropdown-content z-[1] menu p-2 shadow bg-violet-950 rounded-box w-36 mt-4">
                <li><a class="purple200" href="/loginport">สลับบัญชี</a></li>
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
        </div>
    </div>
    <div class="mt-16">
        @yield('content')
    </div>
</div> --}}
