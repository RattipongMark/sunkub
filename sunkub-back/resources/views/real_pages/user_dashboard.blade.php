@extends('real_components/sidebar')

@section('css')
    <link rel="stylesheet" href="/css/user.css">
    @vite('resources/css/app.css')
@endsection

@section('title')
    portfolio
@endsection

@section('contentnav')
    ภาพรวม แดชบอร์ด
@endsection

@section('content')
    <div class="flex-1 mb-4">
        <div class="text-white text-3xl font-bold pt-6 pl-5">
            ยินดีต้อนรับ คุณภูมรี เมืองคอน
        </div>
        <div class="text-white pt-2 pl-5 opacity-75">
            ข้อมูลที่แสดงประวัติการเงินของคุณ
        </div>
    </div>
    <div class="flex-1 ml-5 mr-5 mb-1">
        <div class="flex grid grid-cols-3 drop-shadow-lg gap-5">
            <div class="bg-neutral-700 rounded-2xl p-4 flex flex-col justify-between">
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
            <div class="bg-neutral-700 rounded-2xl p-4 flex flex-col justify-between drop-shadow-lg">
                <div class="text-white text-xl">เงินลงทุนทั้งหมด</div>
                <div class="bg-violet-400 h-14 rounded-2xl flex items-center justify-center">
                    <div class="text-white text-lg">฿58,783</div>
                </div>
            </div>
            <div class="bg-neutral-700 rounded-2xl p-4 flex flex-col justify-between drop-shadow-lg">
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
        <div class="col-span-3 bg-neutral-700 rounded-2xl p-6 drop-shadow-lg">
            <div class="text-white text-xl mb-2">รายละเอียดการลงทุน</div>
            <div class="text-white text-sm opacity-75 mb-10">สินทรัพย์ที่คุณมีในบัญชีของคุณ</div>
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
            </div>
        </div>
        <div class="col-span-2 bg-neutral-700 rounded-2xl p-6 h-auto drop-shadow-lg">
            <div class="flex flex-col">
                <div class="text-white text-xl">เงินลงทุนทั้งหมดทุกบัญชีของคุณ</div>
                <div class="text-white pt-2 opacity-75">สินทรัพย์ที่คุณมีในทุกบัญชีของคุณ</div>
                <div class="flex justify-center">
                    <div class="text-white mt-10 mb-10 text-3xl">฿98,765</div>
                </div>
                <div class="flex flex-col">
                    <div class="flex flex-row pr-6 pl-6">
                        <div class="bg-violet-400 h-14 w-28 flex items-center justify-center mr-2">
                            <div class="text-white text-lg">SCB</div>
                        </div>
                        <div class="bg-violet-400 h-14 rounded-r-2xl flex-1">
                            <div class="text-white text-lg flex justify-center mt-3.5">฿58,783</div>
                        </div>
                    </div>
                    <div class="flex flex-row pr-6 pl-6 mt-2">
                        <div class="bg-violet-400 h-14 w-28 flex items-center justify-center mr-2">
                            <div class="text-white text-lg">SCB</div>
                        </div>
                        <div class="bg-violet-400 h-14 rounded-r-2xl flex-1">
                            <div class="text-white text-lg flex justify-center mt-3.5">฿58,783</div>
                        </div>
                    </div>
                    <div class="flex flex-row pr-6 pl-6 mt-2">
                        <div class="bg-violet-400 h-14 w-28 flex items-center justify-center mr-2">
                            <div class="text-white text-lg">SCB</div>
                        </div>
                        <div class="bg-violet-400 h-14 rounded-r-2xl flex-1">
                            <div class="text-white text-lg flex justify-center mt-3.5">฿58,783</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
