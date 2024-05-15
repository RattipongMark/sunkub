@extends('real_components/sidebar')

@section('css')
    <link rel="stylesheet" href="/css/user.css">
    @vite('resources/css/app.css')
@endsection

@section('title')
    portfolio
@endsection

@section('contentnav')
    ภาพรวม แดชบอร์ด
@endsection

@section('content')
    <div class="flex flex-col h-full ">
        <div class="mb-4">
            <div class="text-white text-3xl font-bold pt-6 pl-5">
                ยินดีต้อนรับ คุณภูมรี เมืองคอน
            </div>
            <div class="text-white pt-2 pl-5 opacity-75">
                ข้อมูลที่แสดงประวัติการเงินของคุณ
            </div>
        </div>
        <div class="flex justify-center">
            <div class="lds-ellipsis" id="loaditem">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div id="pagecontent" class="content fadecontent">
                <div class="flex-1 ml-7 mr-7 mb-3">
                    <div class="flex grid grid-cols-3 drop-shadow-lg gap-3">
                        <div class="bg-neutral-700 rounded-2xl p-4 flex flex-col justify-between">
                            <div class="text-white text-xl mb-10">เงินในบัญชี</div>
                            <div class="flex flex-row">
                                <div class="bg-violet-400 h-14 w-full rounded-2xl flex items-center justify-center">
                                    <div class="text-white text-lg">$ {{ $port->balance }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-neutral-700 rounded-2xl p-4 flex flex-col justify-between drop-shadow-lg">
                            <div class="text-white text-xl">เงินลงทุนทั้งหมด</div>
                            <div class="bg-violet-400 h-14 rounded-2xl flex items-center justify-center">
                                <div class="text-white text-lg">$ {{ $amountmoney }}</div>
                            </div>
                        </div>
                        <div class="bg-neutral-700 rounded-2xl p-4 flex flex-col justify-between drop-shadow-lg">
                            <div class="text-white text-xl">กำไรรวม</div>
                            <div class="flex flex-row justify-between">
                                <div class="bg-violet-400 h-14 w-56 rounded-2xl flex-auto pl-5 mr-4">
                                    <div class="text-white text-lg mt-3.5">$ {{number_format($profit,4)}}</div>
                                </div>
                                @php
                                    if ($percen_profit < 0) {
                                        $color = 'red';
                                    }
                                    else {
                                        $color = 'green';
                                    }
                                @endphp
                                <div class="bg-{{ $color }}-400 h-14 w-24 rounded-2xl flex items-center justify-center">
                                    <div class="text-black text-lg">{{number_format($percen_profit,2)}}%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex grid grid-cols-5 gap-3 p-2 pl-10 pr-10">
                    <div class="col-span-3 bg-neutral-700 rounded-2xl p-6 drop-shadow-lg ml-5">
                        <div class="text-white text-xl mb-2">รายละเอียดการลงทุน</div>
                        <div class="text-white text-sm opacity-75 mb-10">สินทรัพย์ที่คุณมีในบัญชีของคุณ</div>
                        <div class="text-white text-3xl mb-2">$ {{ $amountmoney }}</div>
                        {{-- <div class="flex flex-row justify-between">
                            <div class="flex-auto bg-violet-400 h-14 w-56 rounded-l-2xl mr-2"></div>
                            <div class="flex-auto bg-violet-300 h-14 w-56 mr-2"></div>
                            <div class="flex-auto bg-purple-300 h-14 w-16 mr-2"></div>
                            <div class="flex-auto bg-purple-200 h-14 w-16 mr-2"></div>
                            <div class="flex-auto bg-violet-50 h-14 w-16 rounded-r-2xl"></div>
                        </div> --}}
                        <div class="flex flex-row w-full gap-2 px-4 pt-2">
                            @foreach ($amountstock as $index => $stock)
                                @php
                                    $maxidx = count($amountstock) - 1;
                                    $color = '';
                                    $rd = ''; // เริ่มต้นตัวแปรสีเป็นช่องว่าง
                                    if($index == $maxidx && $maxidx == 0){
                                        $color = 'bg-violet-400';
                                        $rd = 'rounded-2xl';
                                    }
                                    else{
                                    switch ($index % 5) {
                                        // ใช้ modulus operator (%) เพื่อเปลี่ยนสีทุก 5 รายการ
                                        case 0:
                                            $color = 'bg-violet-400';
                                            $rd = 'rounded-l-2xl'; // สีเข้ม
                                            break;
                                        case 1:
                                            $color = 'bg-violet-300'; // สีกลาง
                                            break;
                                        case 2:
                                            $color = 'bg-violet-200'; // สีอ่อน
                                            break;
                                        case 3:
                                            $color = 'bg-violet-100'; // สีอ่อนมาก
                                            break;
                                        case 4:
                                            $color = 'bg-violet-50'; // สีสว่าง
                                            break;
                                        default:
                                            $color = 'bg-white'; // สีเข้ม (ถ้า index เกิน 4)
                                    }

                                    if ($index == $maxidx) {
                                        $rd = 'rounded-r-2xl';
                                    }
                                }
                                @endphp
                                <div class="{{ $color }} h-14 {{ $rd }}"
                                    style="width: {{ number_format($percen[$stock->stock_symbol],2) }}%;">
                                </div>
                            @endforeach
                        </div>


                        <div class="pl-24 pr-24">
                            @foreach ($amountstock as $index => $stock)
                                @php
                                    $maxidx = count($amountstock) - 1;
                                    $color = '';
                                    $rd = ''; // เริ่มต้นตัวแปรสีเป็นช่องว่าง
                                    switch ($index % 5) {
                                        // ใช้ modulus operator (%) เพื่อเปลี่ยนสีทุก 5 รายการ
                                        case 0:
                                            $color = 'bg-violet-400'; // สีเข้ม
                                            break;
                                        case 1:
                                            $color = 'bg-violet-300'; // สีกลาง
                                            break;
                                        case 2:
                                            $color = 'bg-violet-200'; // สีอ่อน
                                            break;
                                        case 3:
                                            $color = 'bg-violet-100'; // สีอ่อนมาก
                                            break;
                                        case 4:
                                            $color = 'bg-violet-50'; // สีสว่าง
                                            break;
                                        default:
                                            $color = 'bg-white'; // สีเข้ม (ถ้า index เกิน 4)
                                    }

                                @endphp
                                <div class="flex flex-row gap-8 mt-8 ">
                                    <div class="flex-none {{$color}} w-4 h-4 rounded-2xl mt-1.5"></div>
                                    <div class="text-white text-lg text-left">{{ $stock->stock_symbol }}</div>
                                    <div class="text-white text-lg text-center w-full">
                                        {{ number_format($stock->total_buy_amount, 2) }}
                                    </div>
                                    <div class="text-white text-lg text-right">
                                        {{ number_format($percen[$stock->stock_symbol], 2) }}%
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                    <div class="col-span-2 bg-neutral-700 rounded-2xl p-6 mr-5 h-auto  drop-shadow-lg">
                        <div class="flex flex-col">
                            <div class="text-white text-xl">เงินลงทุนทั้งหมดทุกบัญชีของคุณ</div>
                            <div class="text-white pt-2 opacity-75">สินทรัพย์ที่คุณมีในทุกบัญชีของคุณ</div>
                            <div class="flex justify-center">
                                <div class="text-white mt-10 mb-10 text-3xl">$ {{ $totalinvest }}</div>
                            </div>
                            <div class="flex flex-col">
                                @foreach ($amountport as $port)
                                    <div class="flex flex-row pr-6 pl-6 mt-2">
                                        <div class="bg-violet-400 h-14 w-28 flex items-center justify-center mr-2">
                                            <div class="text-white text-lg">{{ $port->broker_name }}</div>
                                        </div>
                                        <div class="bg-violet-400 h-14 rounded-r-2xl flex-1">
                                            <div class="text-white text-lg flex justify-center mt-3.5">
                                                $ {{ number_format($port->total_buy_amount, 0, '.', ',') }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
