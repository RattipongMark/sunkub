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
    Admin Dash Board 
@endsection

@section('contentnav')
     ภาพรวม แดชบอร์ด
@endsection

@section('content')
<div class="flex flex-row justfify-between">
    <div class="flex-1">
        <div class="text-white text-3xl font-bold pt-6 pl-5">
            หุ้นที่ถูกซื้อมากที่สุด
        </div>
        <div class="text-white pt-2 pl-5 opacity-75">
            ข้อมูลหุ้นที่ถูกซื้อมากที่สุด
        </div>
    </div>
</div>
<div class="flex-1 h-full min-h-screen bg-neutral-700 rounded-t-2xl drop-shadow-lg p-0 ml-6 mr-10 mt-5">
    <div class="flex-1 w-full bg-violet-400 rounded-t-2xl drop-shadow-lg mt-2 mr-10">
        <div class="flex flex-col h-full">
            <div class="grid grid-cols-4">
                <div class="text-white flex items-center justify-center text-lg p-6 ml-5">สัญลักษณ์</div>
                <div class="text-white flex items-center justify-center text-lg p-6">ราคาตลาด</div>
                <div class="text-white flex items-center justify-center text-lg p-6">จำนวนหุ้น</div>
                
               
            </div>
        </div>
    </div>
    
    @for ($i=0;$i<3;$i++)
        <div class="flex-1 w-full bg-zinc-800 items-center drop-shadow-lg mt-7">
            <div class="flex flex-col h-full">
                    <div class="grid grid-cols-4">
                        <div class="flex flex-col text-green-400 flex flex-col items-left justify-center text-2xl p-6 ml-32">
                            Acc
                            <div class="flex flex-col text-white flex items-left justify-left text-xl mt-2 opacity-50">
                                    Apple.inc
                            </div>
                        </div>
                        <div class="text-white flex items-center justify-center text-2xl px-8 ">106.02</div>
                        <div class="text-white flex items-center justify-center text-2xl "> 1,200 </div>
                        <div class="text-white flex-col items-center justify-center text-2xl p-6 ml-28 ">
                            NASDAQ
                            <div class="flex flex-col text-white flex items-left justify-left text-xl mt-2 opacity-50"> หุ้นธรรมดา</div>
                        </div>
                        
                    </div>
            </div>
        </div>
    @endfor
                


</div>
@endsection