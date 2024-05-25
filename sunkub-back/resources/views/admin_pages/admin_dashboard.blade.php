@extends('real_components.sidebar_admin')

@section('css')
    <link rel="stylesheet" href="/css/manageBroke.css">
    <link rel="stylesheet" href="/css/user.css">
    @vite('resources/css/app.css')
@endsection


@section('title')
    Admin Dashboard
@endsection

@section('contentnav')
    ภาพรวม แดชบอร์ด
@endsection
@php
    $fontColors = ['text-purple-200', 'text-purple-300', 'text-violet-300', 'text-violet-400']; //define background colors
@endphp

@section('content')
    <div class="pl-7 mt-3">
        <p class="text-white text-3xl ">ยินดีต้อนรับ แอดมิน</p>
        <p class="text-base text-gray-200 mt-1">ข้อมูลที่แสดงกิจกรรมต่าง ๆ ที่เกิดขึ้นบนเว็บไซต์ของคุณ</p>
    </div>
    <div class="mt-5 grid grid-rows-2 px-8 gap-4">
        <div class="grid grid-cols-2 gap-4">
            <a href="/admin/buythemost">
                <div class="h-72 bg-neutral-700 rounded-xl px-5 py-4 hover:outline outline-offset-2 outline-purple-200">
                    <p class="text-white text-2xl ">หุ้นที่ถูกซื้อมากที่สุดในแต่ละบริษัทหลักทรัพย์</p>
                    <p class="text-sm mt-2 text-gray-200 opacity-50">แสดงหุ้น 3 อันดับ</p>
                    <div class="px-20 mb-3 place-content-center	">
                        @foreach ($topbuybroker as $idx => $broker)
                            <div class="flex justify-between items-center px-3 mt-3">
                                <p class="text-lg {{ $fontColors[$idx % 3] }}">{{ $broker->broker_name }}</p>
                                <p class="text-lg {{ $fontColors[$idx % 3] }}">{{ $broker->total_volume }} หุ้น</p>
                            </div>
                            <hr class="border-white border-solid border-1 mt-1 w-full ">
                        @endforeach
                    </div>
                </div>
            </a>
            <a href="/admin/sellthemost">
                <div class="h-72 bg-neutral-700 rounded-xl px-5 py-4 hover:outline outline-offset-2 outline-purple-200">
                    <p class="text-white text-2xl">หุ้นที่ถูกขายมากที่สุดในแต่ละบริษัทหลักทรัพย์</p>
                    <p class="text-sm mt-2 text-gray-200  opacity-50">แสดงหุ้น 3 อันดับ</p>
                    <div class="px-20 mb-3 place-content-center	">
                        @foreach ($topsellbroker as $idx => $broker)
                            <div class="flex justify-between items-center px-3 mt-3">
                                <p class="text-lg {{ $fontColors[$idx % 3] }}">{{ $broker->broker_name }}</p>
                                <p class="text-lg {{ $fontColors[$idx % 3] }}">{{ $broker->total_volume }} หุ้น</p>
                            </div>
                            <hr class="border-white border-solid border-1 mt-1 w-full ">
                        @endforeach
                    </div>
                </div>
            </a>
        </div>

        <div class="grid grid-cols-2 gap-4 pb-8">
            <a href="/admin/sectorbuy">
            <div class="px-5 py-4 flex h-64 bg-neutral-700  rounded-xl hover:outline outline-offset-2 outline-purple-200 ">
                <div class="flex flex-col h-full w-full">
                    <p class="text-white text-2xl">จำนวนหุ้นที่ถูกซื้อในแต่ละ sector</p>
                    <p class="text-sm mt-2 text-gray-200  opacity-50">แสดงหุ้น 3 อันดับ</p>
                    <div class="px-4 flex flex-rows-3 justify-between flex-grow w-full mt-4">
                        @foreach ($topbuysec as $sector)
                        <div class="flex flex-col items-center ">
                            <div class="flex mt-auto text-white">{{ $sector->total_volume }} หุ้น</div>
                            <div class="flex mt-0 text-black bg-violet-300 w-24 "
                                style="height: {{ number_format($percenbuy[$sector->sector_name], 2) }}%;"></div>
                            <div class="flex items-center justify-center pb-2 text-black bg-violet-300 w-24 text-base text-center ">
                                {{ $sector->sector_name }}</div>
                        </div>
                    @endforeach
                    </div>
                    <div class="flex h-2 bg-purple-400 mt-auto w-full"></div>
                </div>
            </div>
        </a>
        <a href="/admin/sectorsell">
            <div class="px-5 py-4 flex h-64 bg-neutral-700  rounded-xl hover:outline outline-offset-2 outline-purple-200 ">
                <div class="flex flex-col h-full w-full">
                    <p class="text-white text-2xl">จำนวนหุ้นที่ถูกขายในแต่ละ sector</p>
                    <p class="text-sm mt-2 text-gray-200  opacity-50">แสดงหุ้น 3 อันดับ</p>
                    <div class="px-4 flex flex-rows-3 justify-between flex-grow w-full mt-4">
                        @foreach ($topsellsec as $sector)
                        <div class="flex flex-col items-center ">
                            <div class="flex mt-auto text-white">{{ $sector->total_volume }} หุ้น</div>
                            <div class="flex mt-0 text-black bg-violet-300 w-24"
                                style="height: {{ number_format($percensell[$sector->sector_name], 2) }}%;"></div>
                            <div class="flex items-center justify-center pb-2 text-black bg-violet-300 w-24 text-base text-center ">
                                {{ $sector->sector_name }}</div>
                        </div>
                    @endforeach
                    </div>
                    <div class="flex h-2 bg-purple-400 mt-auto w-full"></div>
                </div>
            </div>
        </a>
        </div>
    </div>
@endsection
