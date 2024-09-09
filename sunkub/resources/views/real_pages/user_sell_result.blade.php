@extends('real_components.sidebar')

@section('css')
    <link rel="stylesheet" href="/css/user.css">
    @vite('resources/css/app.css')
@endsection

@section('title')
    Selling
@endsection

@section('contentnav')
    ตลาดหุ้น
@endsection

@section('content')
    <div class="cardliststock mx-8 mt-8 flex flex-col h-screen px-4 ">
        <form action="{{ route('poststock', ['stock_symbol' => $stock->stock_symbol]) }}" method="GET">
            @csrf
            <button type="submit" class="pt-3"><img src="/images/ArrowLeft.svg" alt=""></button>
        </form>
        @if ($success)
            <div class="ml-3">
                <div class=" text-3xl text-white">
                    ยินดีด้วย ! การขายหุ้นของคุณสำเร็จแล้ว
                </div>
                <div class="text-base mt-2 text-thin text-gray-200 opacity-75">
                    ลองตรวจดูที่ “กระเป๋าตังค์” ของคุณสิ
                </div>
            </div>

            <div class="bg-zinc-800 mt-3 rounded-t-xl h-full px-5 pt-4">
                <div class="flex justify-center py-4">
                    <img src="{{ url('images/CheckCirclePP.svg') }}" alt="">
                </div>
                <div class="grid grid-rows-3 justify-items-center">
                    <div class="text-white opacity-50">คุณส่งคำสั่งการขายหุ้น {{ $stock_symbol }} แบบใช้ราคาตลาด</div>
                    <div class="text-4xl text-white opacity-50% pt-2">จำนวน {{ $volume }} หุ้น</div>
                    <div class="text-green-400 pt-4">สำเร็จแล้ว</div>
                </div>
            </div>
        @else
            <div class="ml-3">
                <div class=" text-3xl text-white">
                    เสียใจด้วย ! การขายหุ้นของคุณไม่สำเร็จแล้ว
                </div>
                <div class="text-base mt-2 text-thin text-gray-200 opacity-75">
                    กรุณาตรวจสอบรายละเอียดการสั่งขายอีกครั้ง
                </div>
            </div>

            <div class="bg-zinc-800 mt-3 rounded-t-xl h-full px-5 pt-4">
                <div class="flex justify-center py-4">
                    <img src="{{ url('images/XCircle.svg') }}" alt="">
                </div>
                <div class="grid grid-rows-3 justify-items-center">
                    @if ($insufficient_funds)
                        <div class="text-white opacity-50">จำนวนหุ้นไม่เพียงพอสำหรับการขายหุ้น</div>
                        <div class="text-white opacity-50 pt-1">โปรดตรวจสอบจำนวนหุ้นก่อนขาย</div>
                    @endif
                    @if ($stock_not_found)
                        <div class="text-white opacity-50">ไม่พบข้อมูลราคาหุ้น {{ $stock_symbol }}</div>
                        <div class="text-white opacity-50 pt-1">โปรดลองอีกครั้งภายหลัง</div>
                    @endif
                </div>
            </div>
        @endif

    </div>
@endsection