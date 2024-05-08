@extends('real_components.sidebar_admin')

@section('css')
    <link rel="stylesheet" href="/css/user.css">
    @vite('resources/css/app.css')
@endsection


@section('title')
    Manage Broker
@endsection

@section('contentnav')
    ภาพรวม แดชบอร์ด
@endsection
@php
$bgColors = ['bg-zinc-800', 'bg-zinc-600']; //define background colors
@endphp

@section('content')
    <div class="pl-7 mt-3">
        <p class="text-white text-3xl ">ยินดีต้อนรับ แอดมิน</p>
        <p class="text-base text-gray-200 mt-1">ข้อมูลที่แสดงกิจกรรมต่าง ๆ ที่เกิดขึ้นบนเว็บไซต์ของคุณ</p>
    </div>
    <div class="bg-neutral-700 mx-5 mt-2 rounded-xl h-screen">
        <div class="grid grid-row-2 mt-4">
            <div class="mt-3 rounded-xl  grid grid-rows-auto">
                <div class="grid grid-cols-3 place-items-center">
                    <p class="text-white text-xl">ชื่อตลาดหลักทรัพย์</p>
                    <p class="text-white text-xl">Email</p>
                    <p class="text-white text-xl">เบอร์โทรติดต่อ</p>
                </div>
                @for ($i = 0; $i < 3; $i++)
                <div class="grid grid-cols-3 place-items-center mt-3 {{ $bgColors[$i % 2] }} p-3">
                    <p class="text-violet-400 text-xl ">SUNKUB.com</p>
                    <p class="text-white text-xl pl-2">sunkub@mail.com</p>
                    <p class="text-white text-xl pl-6">0999999999</p>
                </div>
                @endfor
            </div>
        </div>
        <div class="mt-3">
            <a href=""><img src="images/addButton.svg" class="w-full"></a>
        </div>
    </div>
@endsection
