@extends('real_components/sidebar_admin')
@php
    $admin = new stdClass();
    $admin->fname = 'Sun';
    $color=['bg-gray-800','bg-gray-600']
@endphp
@section('css')
    <link rel="stylesheet" href="/css/user.css">
    @vite('resources/css/app.css')
@endsection

@section('title')
    Admin Stock
@endsection

@section('contentnav')
     ภาพรวม Stock
@endsection

@section('content')
<div class="flex flex-row justfify-between">
    <div class="flex-1">
        <div class="text-white text-3xl font-bold pt-6 pl-5">
            การจัดการ Stock
        </div>
        <div class="text-white pt-2 pl-5 opacity-75">
            แก้ไข Stock ในรายการ
        </div>
    </div>
</div>

<div class="flex flex-row grid grid-cols-3 h-full">
@for ($i=0;$i<5;$i++)
        <div class="  relative m-8 mb-10 ">
                 <button class="absolute top-0 left-64 ml-14 ">
                    <img src="images\closebt.svg" alt=""  class="link-img w-20 h-20 mt-14 ml-20">
                </button>
            <!-- Card Component -->
                <div class="  bg-zinc-800 text-white p-10 pt-14 h-full w-full rounded-lg shadow-lg">
                    <div class="text-8xl font-bold text-green-400">
                        AAPL
                    </div>
                    <div class="text-3xl text-gray-400 pl-2">
                        Apple Inc.
                    </div>

                </div>
        </div>
@endfor
<button class=" top-0 left-64 ml-14 ">
         <img src="images\PlusSquare.svg" alt=""  class="link-img ml-20 w-70 h-70">
</button>
</div>
@endsection