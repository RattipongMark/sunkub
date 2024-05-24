@extends('real_components/sidebar_admin')
@php
    $admin = new stdClass();
    $admin->fname = 'Sun';
    $color = ['bg-gray-800', 'bg-gray-600'];
@endphp
@section('css')
    <link rel="stylesheet" href="/css/user.css">
    @vite('resources/css/app.css')
@endsection

@section('title')
    Admin Dash Board
@endsection

@section('contentnav')
    ภาพรวม แดชบอร์ด
@endsection
@php
    $fontColors = ['text-purple-200', 'text-purple-300', 'text-purple-400', 'text-violet-400']; //define background colors
@endphp
@section('content')
    <div class="flex flex-row justfify-between">
        <div class="flex-1">
            <div class="text-white text-3xl font-bold pt-6 pl-5">
                ประเภทหุ้นที่ถูกซื้อมากที่สุด
            </div>
            <div class="text-white pt-2 pl-5 opacity-75">
                ประเภทข้อมูลหุ้นที่ถูกซื้อมากที่สุด
            </div>
        </div>
    </div>
    <div class=" h-full min-h-screen bg-neutral-700 rounded-t-2xl drop-shadow-lg  mx-16 mt-8 pt-4">
        <div class="mb-4 ml-8">
            <a href="/admin/dashboard"><img src="{{ url('images/backArrow.svg') }}" class="size-8"></a>
        </div>
        <div class="grid grid-cols-2 gap-4 px-16">
            @foreach ($rankedResults as $brokerName => $sectors)
                <div class=" bg-neutral-800 rounded-xl p-4 ">
                    <div class="flex gap-2">
                        <div class="text-white text-xl opacity-80">บริษัทหลักทรัพย์ : </div>
                        <div class="text-white text-xl">{{ $brokerName }}</div>
                    </div>
                    <div class="text-sm mt-2 text-gray-200 opacity-50">แสดงประเภทหุ้น 3 อันดับ</div>
                    <div class="mt-8 px-20 mb-3 place-content-cente ">
                        @foreach ($sectors as $idx => $sector)
                            <div class="flex justify-between items-center px-3 mt-3">
                                <p class="text-lg {{ $fontColors[$idx % 3] }}">{{ $sector->sector_name }}</p>
                                <p class="text-lg {{ $fontColors[$idx % 3] }}">{{ $sector->total_volume }} หุ้น</p>
                            </div>
                            <hr class="border-white border-solid border-1 mt-1 w-full ">
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
