@extends('real_components.sidebar')

@section('css')
    <link rel="stylesheet" href="/css/user.css">
    @vite('resources/css/app.css')
@endsection


@section('title')
    Buying
@endsection

@section('contentnav')
    ตลาดหุ้น
@endsection

@section('content')
    <div class="bg-neutral-700 m-5 rounded-xl h-screen">
        <div class="pt-3 ml-4">
            <a href=""><img src="images/backArrow.svg" class="size-6"></a>
        </div>
        <div class="grid grid-row-2 mx-5 mt-4">
            <div class="ml-3">
                <div class=" text-3xl text-white">
                    คำสั่งซื้อของคุณ
                </div>
                <div class="text-base mt-2 text-thin text-gray-200 opacity-75">
                    ข้อมูลที่แสดงคำสั่งซื้อหุ้นของคุณ
                </div>
            </div>
            <div class="bg-zinc-800 mt-3 rounded-xl h-auto">
                <div class="mx-5 mt-4">
                    <div class="text-white text-base">Apple Inc.</div>
                    <div class="text-2xl text-violet-400 mt-2">AAPL</div>
                    <div class="text-white mt-2">173.50 ดอลลาร์ = 6,438.85 บาท</div>
                    <div class="text-white mt-10">จำนวนหุ้นที่ต้องการซื้อ</div>
                    <label class="input input-bordered flex items-center gap-2 bg-white mt-2">
                        <input type="text" class="grow bg-white" placeholder="ใส่จำนวนหุ้นที่ต้องการซื้อ" />
                        <div class="text-black opacity-50">หุ้น</div>
                    </label>
                    <div class="grid grid-cols-2 mt-20">
                        <div class="text-lg text-white mt-1">
                            จำนวนเงินที่ต้องชำระ :
                        </div>
                        <div class="text-white text-3xl flex justify-end">
                            1000 บาท
                        </div>
                    </div>
                    <div class="mt-2">
                        <div class="flex justify-end"><img src="images/checkCircle.svg">
                            <p class="text-green-400 text-lg ml-1"> ไม่มีค่าธรรมเนียม
                        </div>
                    </div>
                    <div class="flex justify-end mt-14">
                        <a href="" class="bg-violet-300 mb-3 rounded-xl hover:bg-violet-400"><p class="text-neutral-800 text-xl mx-4 my-2">ยืนยัน</p></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
