@extends('real_components/sidebar')

@section('css')
    <link rel="stylesheet" href="/css/user.css">
    @vite('resources/css/app.css')
@endsection


@section('title')
    portfolio
@endsection

@section('contentnav')
    ตลาดหุ้น
@endsection
{{-- 
    <h1>Port Information</h1>
<p>User Broker: {{ $port->user_broker }}</p>
<p>Password: {{ $port->password }}</p>

<h1>User Information</h1>
<p>First Name: {{ $user->fname }}</p>
<p>Last Name: {{ $user->lname }}</p>
<p>Email: {{ $user->email }}</p>
ิ   <br><br>

@foreach ($stocks as $stock)
<div>
    <p>Stock Symbol: {{ $stock->stock_symbol }}</p>
    <p>Stock Name: {{ $stock->stock_name }}</p>
    <p>Current Price: {{ $stock->stock_current_price }}</p>
</div>
@endforeach --}}
@section('content')

    <div class="cardliststock mx-8 mt-8 grid justify-items-center h-screen">
        <div class="flex flex-col w-full gap-2">
            @foreach ($stocks as $stock)
            <div class="pb-1">
                <form action="{{ route('poststock', ['stock_symbol' => $stock->stock_symbol]) }}" method="GET">
                    @csrf
                    <input type="hidden" name="stock_symbol" value="{{ $stock->stock_symbol }}">
                    <button type="submit" class="rounded-2xl bg-neutral-800 w-full h-24 drop-shadow-md flex pt-1.5 pl-12 items-center justify-between">
                        <div class="grid grid-rows-2">
                            <div class="text-green-400 text-2xl">{{ $stock->stock_symbol }}</div>
                            <div class="text-white opacity-50 text-sm pt-1">{{ $stock->stock_name }}</div>
                        </div>  
                        <div class="grid grid-cols-2 gap-16">
                            <div class="grid grid-rows-2">
                                <div class="text-white opacity-70 text-base pt-1">อัปเดตเมื่อ</div>
                                <div class="text-white  text-sm pt-1">{{ $stock->updated_at }}</div>
                            </div>
                            <div class="grid grid-rows-2">
                                <div class="text-purple-200 text-2xl">{{ $stock->stock_current_price }}</div>
                                <div class="text-white opacity-50 text-sm pt-1">USD/volume</div>
                            </div>
                        </div>
                    </button>
                </form>
            </div>
            @endforeach
            
        </div>
    </div>
@endsection
