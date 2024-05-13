@extends('real_components/sidebar')

@section('css')
    <link rel="stylesheet" href="/css/user.css">
    @vite('resources/css/app.css')
@endsection

@section('title')
    history
@endsection

@section('contentnav')
    ภาพรวม ประวัติ
@endsection

@section('content')
<div class="flex flex-row justfify-between">
    <div class="flex-1">
        <div class="text-white text-3xl font-bold pt-6 pl-5">
            ประวัติการซื้อขายของคุณ
        </div>
        <div class="text-white pt-2 pl-5 opacity-75">
            ข้อมูลที่แสดงประวัติการซื้อขาย
        </div>
    </div>
</div>
<div class="flex-1 h-screen bg-neutral-700 rounded-t-2xl drop-shadow-lg p-0 ml-6 mr-10 mt-5">
    <div class="flex-1 w-full bg-violet-400 rounded-t-2xl drop-shadow-lg mt-2 mr-10">
        <div class="flex flex-col h-full">
            <div class="grid grid-cols-5">
                <div class="text-white flex items-center justify-center text-lg p-6 ml-5">สัญลักษณ์</div>
                <div class="text-white flex items-center justify-center text-lg p-6">ปริมาณการซื้อขาย</div>
                <div class="text-white flex items-center justify-center text-lg p-6">ประเภท</div>
                <div class="text-white flex items-center justify-center text-lg p-6">ราคา</div>
                <div class="text-white flex items-center justify-center text-lg p-6 mr-5">วัน/เดือน/ปี</div>
            </div>
        </div>
    </div>
    <div class="flex-1 w-full bg-zinc-800 items-center drop-shadow-lg mt-7">
        <div class="flex flex-col h-full">
            <div class="grid grid-cols-5">
                <div class="text-white flex items-center justify-center text-lg p-6 ml-5">AAPL</div>
                <div class="text-white flex items-center justify-center text-lg p-6">test</div>
                <div class="text-white flex items-center justify-center text-lg p-6">ซื้อ</div>
                <div class="text-white flex items-center justify-center text-lg p-6">test</div>
                <div class="text-white flex items-center justify-center text-lg p-6 mr-5">test</div>
            </div>
        </div>
    </div>
    <div class="flex-1 w-full bg-zinc-600 items-center drop-shadow-lg mt-3">
        <div class="flex flex-col h-full">
            <div class="grid grid-cols-5">
                <div class="text-white flex items-center justify-center text-lg p-6 ml-5">AAPL</div>
                <div class="text-white flex items-center justify-center text-lg p-6">test</div>
                <div class="text-white flex items-center justify-center text-lg p-6">ขาย</div>
                <div class="text-white flex items-center justify-center text-lg p-6">test</div>
                <div class="text-white flex items-center justify-center text-lg p-6 mr-5">test</div>
            </div>
        </div>
    </div>
    <div class="flex-1 w-full bg-zinc-800 items-center drop-shadow-lg mt-3">
        <div class="flex flex-col h-full">
            <div class="grid grid-cols-5">
                <div class="text-white flex items-center justify-center text-lg p-6 ml-5">AAPL</div>
                <div class="text-white flex items-center justify-center text-lg p-6">test</div>
                <div class="text-white flex items-center justify-center text-lg p-6">ซื้อ</div>
                <div class="text-white flex items-center justify-center text-lg p-6">test</div>
                <div class="text-white flex items-center justify-center text-lg p-6 mr-5">test</div>
            </div>
        </div>
    </div>
</div>
@endsection
