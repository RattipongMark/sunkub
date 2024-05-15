@extends('real_components/sidebar')

@section('css')
    <link rel="stylesheet" href="/css/user.css">
    @vite('resources/css/app.css')
@endsection

@section('title')
    portfolio
@endsection

@section('contentnav')
    ภาพรวม พอร์ตโฟลิโอ
@endsection

@section('content')
    <div class="flex flex-row justfify-between">
        <div class="flex-1 mb-4">
            <div class="text-white text-3xl font-bold pt-6 pl-5">
                พอร์ตโฟลิโอของคุณ
            </div>
            <div class="text-white pt-2 pl-5 opacity-75">
                ข้อมูลที่แสดงพอร์ตโฟลิโอของคุณ
            </div>
        </div>
    </div>
    <div class="flex flex-row justify-between">
        <div class="flex-1 h-48 bg-neutral-700 rounded-l-2xl drop-shadow-lg mt-2 ml-6 mr-2 p-3">
            <div class="flex flex-col">
                <div class="text-white text-xl">
                    จำนวนหุ้นที่คุณมีทั้งหมดทุกบัญชีของคุณ
                </div>
                <div class="text-white opacity-75 mt-1">
                    จำนวนหุ้นทั้งหมดของคุณ
                </div>
                <div class="flex text-white text-3xl items-center justify-center mt-4">
                    {{ $volume_account }} หุ้น
                </div>
            </div>
        </div>
        <div class="flex-1 h-48 bg-neutral-700 rounded-r-2xl drop-shadow-lg mt-2 mr-10 p-3">
            <div class="flex flex-col h-full">
                <div class="grid grid-cols-3 flex-grow">
                    @foreach ($volume_eachport as $port)
                        <div class="flex flex-col items-center ml-20">
                            <div class="flex mt-auto text-white">{{ $port['remaining_volume'] }} หุ้น</div>
                            <div class="flex mt-0 text-black bg-violet-300 w-24"
                                style="height: {{ $percen[$port['port_id']] }}%;"></div>
                            <div class="flex items-center justify-center mt-0 text-black bg-violet-300 w-24 text-xs">
                                {{ $port['broker_name'] }}</div>
                        </div>
                    @endforeach
                </div>
                <div class="flex h-2 bg-purple-300 mt-auto ml-5 mr-5"></div>
            </div>
        </div>
    </div>
    <div class="flex-1 h-auto  min-h-screen bg-neutral-700 rounded-t-2xl drop-shadow-lg p-0 mt-4 ml-6 mr-10">
        <div class="flex-1 w-full bg-violet-400 rounded-t-2xl drop-shadow-lg mt-2 mr-10">
            <div class="flex flex-col h-full">
                <div class="grid grid-cols-6">
                    <div class="text-white flex items-center justify-center text-lg p-6 ml-5">สัญลักษณ์</div>
                    <div class="text-white flex items-center justify-center text-lg p-6">จำนวนหุ้น</div>
                    <div class="text-white flex items-center justify-center text-lg p-6">จำนวนหุ้นรวม</div>
                    <div class="text-white flex items-center justify-center text-lg p-6">ราคาเฉลี่ย</div>
                    <div class="text-white flex items-center justify-center text-lg p-6">ราคาตลาด</div>
                    <div class="text-white flex items-center justify-center text-lg p-6 text-center">กำไร / ขาดทุน <br>
                        ที่ยังไม่ปิดสถานะ</div>
                </div>
            </div>
        </div>
        {{--  --}}
        @foreach ($volume_eachstock as $stock)
            <div class="flex-1 w-full bg-zinc-600 items-center drop-shadow-lg mt-7">
                <div class="flex flex-col h-full">
                    <div class="grid grid-cols-6">
                        <div class="text-white flex items-center justify-center text-lg p-6 ml-5">{{ $stock['symbol'] }}
                        </div>
                        <div class="text-white flex items-center justify-center text-lg p-6">
                            {{ $stock['remaining_volume'] }}</div>
                        <div class="text-white flex items-center justify-center text-lg p-6">{{$stock['remaining_volume_eachport']}}</div>
                        <div class="text-white flex items-center justify-center text-lg p-6">{{ $stock['avg'] }}</div>
                        <div class="text-white flex items-center justify-center text-lg p-6">{{ $stock['currentPrice'] }}
                        </div>
                        <div
                            class="flex items-center justify-center text-lg p-6 mr-5 @if ($stock['currentPrice'] - $stock['avg'] < 0) text-red-400 @else text-green-400 @endif">
                            {{ number_format($stock['currentPrice'] - $stock['avg'], 2) }}</div>
                    </div>
                </div>
            </div>
        @endforeach

        {{--  --}}

    </div>
@endsection
