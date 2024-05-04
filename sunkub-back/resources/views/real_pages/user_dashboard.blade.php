<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

            <!-- div ก้อนนี้เป็นของแถบสีดำด้านบน -->
            <div class="navbar bg-zinc-800 text-white flex justify-between p-5 pl-5 pr-5">
                <div>ภาพรวม แดชบอร์ด</div>
                <div class="flex items-center">
                    <div class="mr-4">ภูมรี เมืองคอน</div>
                    <img src="https://via.placeholder.com/30x30" alt="" class="mr-5"></img>
                </div>
            </div>

            <div class="flex-1 mb-4">
                <div class="text-white text-3xl font-bold pt-6 pl-5">
                    ยินดีต้อนรับ คุณภูมรี เมืองคอน
                </div>
                <div class="text-white pt-2 pl-5 opacity-75">
                    ข้อมูลที่แสดงประวัติการเงินของคุณ
                </div>
            </div>
            <div class="flex-1">
                <div class="flex grid grid-cols-3 gap-5 p-1 pl-10 pr-10">
                    <div class="bg-neutral-700 rounded-2xl p-5 flex flex-col justify-between">
                        <div class="text-white text-xl mb-10">เงินในบัญชี</div>
                        <div class="flex flex-row">
                            <div class="bg-violet-400 h-14 w-56 rounded-2xl flex-auto pl-5 mr-4">
                                <div class="text-white text-lg mt-3.5">฿10,000</div>
                            </div>
                            <div class="bg-green-400 h-14 w-16 rounded-2xl flex items-center justify-center">
                                <div class="text-black text-lg">+5.8%</div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-neutral-700 rounded-2xl p-5 flex flex-col justify-between">
                        <div class="text-white text-xl">เงินลงทุนทั้งหมด</div>
                        <div class="bg-violet-400 h-14 rounded-2xl flex items-center justify-center">
                            <div class="text-white text-lg">฿58,783</div>
                        </div>
                    </div>
                    <div class="bg-neutral-700 rounded-2xl p-5 flex flex-col justify-between">
                        <div class="text-white text-xl">กำไรรายสัปดาห์</div>
                        <div class="flex flex-row justify-between">
                            <div class="bg-violet-400 h-14 w-56 rounded-2xl flex-auto pl-5 mr-4">
                                <div class="text-white text-lg mt-3.5">฿840</div>
                            </div>
                            <div class="bg-green-400 h-14 w-16 rounded-2xl flex items-center justify-center">
                                <div class="text-black text-lg">+3.2%</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex grid grid-cols-5 gap-5 p-2 pl-10 pr-10">
                <div class="col-span-3 bg-neutral-700 rounded-2xl p-6">
                    <div class="text-white text-xl mb-2">รายละเอียดการลงทุน</div>
                    <div class="text-white text-sm opacity-75 mb-7">สินทรัพย์ที่คุณมีในบัญชีของคุณ</div>
                    <div class="text-white text-3xl mb-2">฿58,783</div>
                    <div class="flex flex-row justify-between">
                        <div class="flex-auto bg-violet-400 h-14 w-56 rounded-l-2xl mr-2"></div>
                        <div class="flex-auto bg-violet-300 h-14 w-56 mr-2"></div>
                        <div class="flex-auto bg-purple-300 h-14 w-16 mr-2"></div>
                        <div class="flex-auto bg-purple-200 h-14 w-16 mr-2"></div>
                        <div class="flex-auto bg-violet-50 h-14 w-16 rounded-r-2xl"></div>
                    </div>
                    <div class="pl-28 pr-28">
                        <div class="flex flex-row items-center justify-between mt-8">
                            <div class="flex items-center">
                                <img src="https://via.placeholder.com/30x30" alt="" class="mr-9"></img>
                                <div class="text-white text-lg">AAPL</div>
                            </div>
                            <div class="flex items-center">
                                <div class="text-white text-lg mr-12">12345</div>
                                <div class="text-white text-lg">12%</div>
                            </div>
                        </div>
                        <div class="flex flex-row items-center justify-between mt-2">
                            <div class="flex items-center">
                                <img src="https://via.placeholder.com/30x30" alt="" class="mr-9"></img>
                                <div class="text-white text-lg">AAPL</div>
                            </div>
                            <div class="flex items-center">
                                <div class="text-white text-lg mr-12">12345</div>
                                <div class="text-white text-lg">12%</div>
                            </div>
                        </div>
                        <div class="flex flex-row items-center justify-between mt-2">
                            <div class="flex items-center">
                                <img src="https://via.placeholder.com/30x30" alt="" class="mr-9"></img>
                                <div class="text-white text-lg">AAPL</div>
                            </div>
                            <div class="flex items-center">
                                <div class="text-white text-lg mr-12">12345</div>
                                <div class="text-white text-lg">12%</div>
                            </div>
                        </div>
                        <div class="flex flex-row items-center justify-between mt-2">
                            <div class="flex items-center">
                                <img src="https://via.placeholder.com/30x30" alt="" class="mr-9"></img>
                                <div class="text-white text-lg">AAPL</div>
                            </div>
                            <div class="flex items-center">
                                <div class="text-white text-lg mr-12">12345</div>
                                <div class="text-white text-lg">12%</div>
                            </div>
                        </div>
                        <div class="flex flex-row items-center justify-between mt-2">
                            <div class="flex items-center">
                                <img src="https://via.placeholder.com/30x30" alt="" class="mr-9"></img>
                                <div class="text-white text-lg">AAPL</div>
                            </div>
                            <div class="flex items-center">
                                <div class="text-white text-lg mr-12">12345</div>
                                <div class="text-white text-lg">12%</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-2 bg-neutral-700 rounded-2xl p-6 h-64">
                    <div class="flex flex-col">
                        <div class="text-white text-xl">ผลประกอบการรายวัน</div>
                        <div class="p-6">
                            <div class="flex flex-row justify-between">
                                <div class="text-white mb-2">AAPL</div>
                                <div class="text-green-400 mr-12">+5.0%</div>
                            </div>
                            <div class="flex flex-row justify-between">
                                <div class="text-white mb-2">AAPL</div>
                                <div class="text-red-400 mr-12">-5.0%</div>
                            </div>
                            <div class="flex flex-row justify-between">
                                <div class="text-white mb-2">AAPL</div>
                                <div class="text-green-400 mr-12">+5.0%</div>
                            </div>
                            <div class="flex flex-row justify-between">
                                <div class="text-white mb-2">AAPL</div>
                                <div class="text-red-400 mr-12">-5.0%</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
