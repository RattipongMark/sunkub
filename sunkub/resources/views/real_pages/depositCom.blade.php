@extends('real_components.sidebar')

@section('css')
    <link rel="stylesheet" href="/css/user.css">
    @vite('resources/css/app.css')
@endsection


@section('title')
    Buying Complete
@endsection

@section('contentnav')
    ตลาดหุ้น
@endsection

@section('content')
    <div class="bg-neutral-700 m-5 rounded-xl min-h-dvh h-full">
        <div class="pt-3 ml-4">
            <a href="/mywallet"><img src="images/backArrow.svg" class="size-6"></a>
        </div>
        <div class="grid grid-row-2 mx-5 mt-4">
            <div class="ml-3">
                <div class=" text-3xl text-white">
                    ฝากเงินเข้าบัญชีของคุณเรียบร้อยแล้ว ! 
                </div>
                <div class="text-base mt-2 text-thin text-gray-200 opacity-75">
                    ข้อมูลที่แสดงคำสั่งฝากเงินของคุณ
                </div>
            </div>
            <div class="bg-zinc-800 mt-3 rounded-xl  flex flex-col pb-24 px-8">
                <div class="flex justify-center mt-8">
                    <img src="images/checkCircle_violet.svg">
                </div> 
                <div class="px-8 pt-4">
                    <div class="flex justify-between">
                        <p class="text-white text-base px-3">{{ $user->fname }}  {{ $user->lname }}</p>
                        <div class="text-violet-400 text-base px-3" id="cardNumber">cardnumber : {{ $cardNumber }} </div>
                    </div>
                    
                    <p class="mt-9 text-white px-3">วันที่ส่งคำสั่ง : 10/20/30 - 20:30</p>
                    <hr class="border-white mt-4 border-solid border-1">
                </div>
                <div class="px-4">
                    <p class="text-white px-3 mt-4">ข้อมูลการฝากเงิน :</p>
                    @foreach ($portsData as $port)
                        <div class="grid grid-cols-2 mt-4 px-9">
                            <p class="text-violet-400 "><span style="color:#a78bfa ">พอร์ตโฟลิโอ {{ $port['name'] }} <span
                                        style="color:white ">ฝากเงินเข้าเป็นจำนวน</p>
                            <p class="text-white flex justify-end">{{ $port['amount_deposited'] }} $</p>
                        </div>
                    <hr class="border-white mt-4 border-solid border-1">
                    @endforeach
                </div>
                <div class="flex justify-between px-8 mt-6 ">       
                    <p class="text-white flex justify-center opacity-80">สำเร็จแล้ว !</p>
                    <div class="flex justify-end gap-2">
                        <p class="text-white flex justify-center opacity-80">คุณได้ส่งคำสั่งฝากเงินมูลค่า : </p>
                        <p class="text-purple-400 flex justify-center opacity-80"> {{ $totalAmount }} $ </p>
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
