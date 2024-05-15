@extends('real_components/sidebar')

@section('css')
    <link rel="stylesheet" href="/css/user.css">
    @vite('resources/css/app.css')
@endsection

@section('title')
    My Wallet
@endsection

@section('contentnav')
    กระเป๋าตังค์ของฉัน
@endsection

@section('content')
<div class="flex flex-col justfify-between content-center h-full">
    <div class="flex-1 mb-4 ml-10">
        <div class="text-white text-3xl font-bold pt-6 pl-5">
            กระเป๋าตังค์ของคุณ
        </div>
        <div class="text-white pt-2 pl-5 opacity-75">
            ข้อมูลที่แสดงเงินในบัญชี
        </div>
    </div>
    <div class="w-5/6 h-72 flex flex-col bg-violet-300 rounded ml-32 mt-4 drop-shadow-lg  ">
        <div class ="flex flex-row w-11/12 h-50 ml-14 mt-4 bg-zinc-500 rounded drop-shadow-lg ">
            <img src="images\Wallet.png" alt=""  class="link-img w-10 h-10 mt-14 ml-20">
            <h1 class = "mt-14 ml-4 text-white text-4xl "> ยอดเงินในบัญชี </h1>
            <div class="mt-14 ml-96">
                <h1 class =  "text-white text-4xl "> 123,456 </h1>
            </div>
            <h1 class = "mt-14 ml-4 text-white text-4xl "> ฿ </h1>
        </div>
        <div class="flex flex-row">
        <div class="flex flex-col mt-4 ml-32">
            <h1 class =  "text-zinc-800 text-xl "> Withdraw limit</h1>
            <h1 class =  "text-zinc-800 text-xl "> Deposit limit</h1>
         </div>
         <div class="flex flex-col mt-4 ml-4 mr-32">
            <h1 class =  "text-zinc-800 text-xl "> 0/2,000,000</h1>
            <h1 class =  "text-zinc-800 text-xl ">0/2,000,000</h1>
         </div>
         <button class="w-32 h-14 mt-4 ml-96 bg-green-400 hover:bg-green-300 text-white font-bold text-2xl  drop-shadow-lg rounded">
                ฝาก
        </button>
        <button class="w-32 h-14 mt-4 ml-4 bg-red-400 hover:bg-red-300 text-white font-bold text-2xl drop-shadow-lg rounded">
                ถอน
        </button>
         </div>
    </div>  
</div>




@endsection
