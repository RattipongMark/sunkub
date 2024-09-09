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
<div class="flex flex-col content-center h-full">
    <div class="flex-1 mb-4 ml-10">
        <div class="text-white text-3xl font-bold pt-6 pl-5">
            กระเป๋าตังค์ของคุณ
        </div>
        <div class="text-white pt-2 pl-5 opacity-75">
            ข้อมูลที่แสดงเงินในบัญชี
        </div>
    </div>
    <div class="h-72 flex flex-col bg-violet-300 rounded-xl mt-4 drop-shadow-lg  mx-24">
        <div class ="flex flex-row m-4  h-full bg-zinc-500 rounded-xl drop-shadow-lg justify-between">
            <div class="flex">
                <img src="images\wallet2.svg" alt=""  class="link-img w-10 h-10 ml-16 self-center">
                <div class = "ml-4 text-white text-3xl self-center"> ยอดเงินในบัญชี </div>
            </div>
           
            <div class="flex self-center mr-16 gap-4">
                <div class = "text-white text-3xl "> {{ $port->balance}} </div>
                <div class = "text-white text-3xl "> $ </div>
            </div>
        </div>
        <div class="flex flex-row justify-end mr-6 gap-2 mb-8">
        <a href="/deposit_money">
         <button class="w-24 h-12 rounded-xl bg-green-400 hover:bg-green-500 text-white font-bold text-xl ">
                ฝาก
        </button>
    </a>
        <button class="w-24 h-12 rounded-xl bg-red-400 hover:bg-red-500 text-white font-bold text-xl ">
                ถอน
        </button>
         </div>
    </div>  
</div>




@endsection
