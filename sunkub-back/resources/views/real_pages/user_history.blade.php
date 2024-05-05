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
    <div class="flex-1 mb-4">
        <div class="text-white text-3xl font-bold pt-6 pl-5">
            ประวัติการซื้อขายของคุณ
        </div>
        <div class="text-white pt-2 pl-5 opacity-75">
            ข้อมูลที่แสดงประวัติการซื้อขาย
        </div>
    </div>
</div>

<div class="flex-1 h-screen bg-neutral-700 rounded-t-2xl drop-shadow-lg p-0 ml-6 mr-10 mt-5">
    <div></div>
</div>
@endsection
