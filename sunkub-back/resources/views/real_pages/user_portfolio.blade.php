@extends('sidebar')

@section('title')
    portfolio
@endsection

@section('content')
<div class="navbar bg-zinc-800 text-white flex justify-between p-5 pl-5 pr-5">
    <div>ภาพรวม พอร์ตโฟลิโอ</div>
    <div class="flex items-center">
        <div class="mr-4">ภูมรี เมืองคอน</div>
        <img src="https://via.placeholder.com/30x30" alt="" class="mr-5"></img>
    </div>
</div>
<div class="flex flex-row justfify-between">
    <div class="flex-1 mb-4">
        <div class="text-white text-3xl font-bold pt-6 pl-5">
            พอร์ตโฟลิโอของคุณ
        </div>
        <div class="text-white pt-2 pl-5 opacity-75">
            ข้อมูลที่แสดงพอร์ตโฟลิโอของคุณ
        </div>
    </div>
    <div class="pt-6 pr-5">
        
    </div>
</div>
@endsection
