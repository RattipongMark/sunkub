@extends('real_components.sidebar_admin')

@section('css')
    <link rel="stylesheet" href="/css/manageBroke.css">
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
        <p class="text-white text-3xl ">บริษัทตลาดหลักทรัพย์ที่อยู่ภายใต้การดูแลของคุณ</p>
        <p class="text-base text-gray-200 mt-1">ข้อมูลแสดงรายละเอียดตลาดหลักทรัพย์ที่อยู่ในการดูแลของคุณ</p>
    </div>
    <div class="bg-neutral-700 mx-5 mt-2 rounded-xl h-screen">
        <div class="grid grid-row-2 mt-4">
            <div class="flex-1 w-full bg-violet-400 rounded-t-2xl drop-shadow-lg  mr-10">
                <div class="flex flex-col h-full">
                    <div class="grid grid-cols-3 ">
                        <div class="text-white flex items-center justify-center text-lg p-6 ml-5">ชื่อตลาดหลักทรัพย์</div>
                        <div class="text-white flex items-center justify-center text-lg p-6">Email</div>
                        <div class="text-white flex items-center justify-center text-lg p-6 mr-5">จำนวนผู้เทรด</div>
                    </div>
                </div>
            </div>
            <div class=" grid grid-rows-auto ">
                @foreach ($brokers as $idx => $broker)
                @php
                    $userCount = $user_counts->firstWhere('broker_id', $broker->broker_id)->user_count ?? 0;
                @endphp
                <div class="grid grid-cols-3 place-items-center mt-3 {{ $bgColors[$idx % 2] }} p-3">
                    <p class="text-violet-400 text-xl ">{{$broker->broker_name}}</p>
                    <p class="text-white text-xl pl-2">{{$broker->broker_mail}}</p>
                    <p class="text-white text-xl pl-6">{{$userCount}}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
