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
    <div class="bg-neutral-700 m-5 rounded-xl ">
        <div class="pt-3 ml-4">
            <a href=""><img src="images/backArrow.svg" class="size-6"></a>
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
            <div class="bg-zinc-800 mt-3 rounded-xl  grid grid-rows-2">
                <div class="flex justify-center mt-36">
                    <img src="images/checkCircle_violet.svg">
                </div> 
                <div>
                    <p class="text-white flex justify-center mt-3 opacity-80">คุณได้ส่งคำสั่งฝากเงินมูลค่า 1000 บาท </p>
                    <p class="text-white flex justify-center opacity-80">สำเร็จแล้ว !</p>
                </div>
            </div>
        </div>

    </div>
@endsection
