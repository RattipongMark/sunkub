<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | sunkub</title>
    @vite('resources/css/app.css')
    <link href='https://fonts.googleapis.com/css?family=Kanit' rel='stylesheet'>
    <style>
      body {
          font-family: 'Kanit';
      }
    </style>
</head>
<body>
    <div class="bg-zinc-500 flex">
        <div class="flex h-screen">
            <div class="bg-neutral-800">
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
            @yield('content')
        </div>
    </div>
</body>
</html>
