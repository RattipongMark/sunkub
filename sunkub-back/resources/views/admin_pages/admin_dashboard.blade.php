@extends('real_components.sidebar_admin')

@section('css')
    <link rel="stylesheet" href="/css/manageBroke.css">
    <link rel="stylesheet" href="/css/user.css">
    @vite('resources/css/app.css')
@endsection


@section('title')
    Dashboard
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
            <div class=" bg-neutral-700 rounded-xl px-5 py-4 hover:outline outline-offset-2 outline-purple-200 ">
                <p class="text-white text-2xl">จำนวนหุ้นที่ถูกซื้อในแต่ละ sector</p>
                <p class="text-sm mt-2 text-gray-200  opacity-50">แสดงหุ้น 3 อันดับ</p>
                <div class="grid grid-cols-3 h-32">
                    @php
                        $data = [30, 50, 70];
                        $sector = ['IT', 'Media', 'Food'];
                        $align = ['items-end', 'items-center', 'items-start'];
                    @endphp
                    @for ($i = 0; $i < count($data); $i++)
                        <div class="flex flex-col justify-end {{ $align[$i] }}">
                            <p class="text-white mb-1">{{ $data[$i] }}%</p>
                            <div class="relative w-14 bg-violet-400 " style="height: {{ $data[$i] }}%;">
                                <p class="absolute bottom-0 w-14 text-center text-black flex flex-col">{{ $sector[$i] }}
                                </p>
                            </div>
                        </div>
                    @endfor{{-- replace the bar chart here --}}
                </div>
                <div class="flex h-2 bg-violet-400 mt-auto ml-5 mr-5"></div>
            </div>
            <div class="bg-neutral-700 rounded-xl px-5 py-4 hover:outline outline-offset-2 outline-purple-200">
                <p class="text-white text-2xl">จำนวนหุ้นที่ถูกขายในแต่ละ sector</p>
                <p class="text-sm mt-2 text-gray-200 opacity-50">แสดงหุ้น 3 อันดับ</p>
                <div class="grid grid-cols-3 h-32">
                    @php
                        $data = [30, 50, 70];
                        $sector = ['IT', 'Media', 'Food'];
                        $align = ['items-end', 'items-center', 'items-start'];
                    @endphp
                    @for ($i = 0; $i < count($data); $i++)
                        <div class="flex flex-col justify-end {{ $align[$i] }}">
                            <p class="text-white mb-1">{{ $data[$i] }}%</p>
                            <div class="relative w-14 bg-violet-400 " style="height: {{ $data[$i] }}%;">
                                <p class="absolute bottom-0 w-14 text-center text-black flex flex-col">{{ $sector[$i] }}
                                </p>
                            </div>
                        </div>
                    @endfor{{-- replace the bar chart here --}}
                </div>
                <div class="flex h-2 bg-violet-400 mt-auto ml-5 mr-5"></div>
            </div>
        </div>
    </div>
@endsection
