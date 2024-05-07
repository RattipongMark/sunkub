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
{{-- <p>Stock Symbol: {{ $stock->stock_symbol }}</p>
<p>Stock Name: {{ $stock->stock_name }}</p>
<p>Current Price: {{ $stock->stock_current_price }}</p>
    </div> --}}
@section('content')
    <div class="cardliststock mx-8 mt-8 flex flex-col h-full px-4 ">
        <form action="/stock" method="GET">
            @csrf
            <button type="submit" class="pt-3"><img src="/images/ArrowLeft.svg" alt=""></button>
        </form>
        <div class="flex px-8 justify-between w-full">
            <div class="grid grid-rows-2">
                <div class="text-purple-400 text-5xl">{{ $stock->stock_symbol }}</div>
                <div class="text-white opacity-50 text-xl pt-1">{{ $stock->stock_name }}</div>
            </div>
            <div class="grid grid-cols-1 gap-16">
                <div class="grid grid-rows-2 gap-2">
                    <div class="grid grid-cols-2">
                        <div class="text-white text-xl opacity-50 content-center">Broker : </div>
                        <div class="text-back text-xl bg-green-400 px-2.5 py-1.5 rounded-lg text-center">
                            {{ $broker->broker_name }}</div>
                    </div>
                    <div class="grid grid-cols-2">
                        <div class="text-white text-xl opacity-50 content-center">Sector : </div>
                        <div class="text-white bg-purple-400 px-2.5 py-1.5 text-xl rounded-lg text-center">
                            {{ $sector->sector_name }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-item-center pl-8 pt-2 gap-4">
            <div class="text-white text-l">มูลค่าปัจจุบัน : {{ $stock->stock_current_price }} USD</div>
            <div class="text-white opacity-50 text-l">ราคา ณ {{ $stock->updated_at }}</div>
        </div>
        <div class="flex flex-col justify-center mt-4 mx-3.5 bg-neutral-800 h-full pt-4 cardliststock">
            <!-- TradingView Widget BEGIN -->
            <div class="tradingview-widget-container ">
                <div class="tradingview-widget-container__widget"></div>

                <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-advanced-chart.js" async>
                    {
                        "width": "1200",
                        "height": "500",
                        "symbol": "NASDAQ:{{ $stock->stock_symbol }}",
                        "interval": "D",
                        "timezone": "Etc/UTC",
                        "theme": "dark",
                        "style": "1",
                        "locale": "th_TH",
                        "enable_publishing": false,
                        "hide_side_toolbar": false,
                        "backgroundColor": "rgba(40, 40, 40, 1)",
                        "allow_symbol_change": true,
                        "save_image": false,
                        "calendar": false,
                        "support_host": "https://www.tradingview.com"
                    }
                </script>
            </div>
            <!-- TradingView Widget END -->
            <div class="flex gap-4 px-56 h-24 my-16 justify-center">
                <form action="{{ route('presell', ['stock_symbol' => $stock->stock_symbol]) }}" method="POST" class="w-full h-full">
                    @csrf
                    <input type="hidden" name="stock_symbol" value="{{ $stock->stock_symbol }}">
                    <button type="submit" class="py-4 text-3xl bg-red-400 hover:bg-red-700 w-full text-white text-center content-center rounded-xl">SELL</button>
                </form>
                <form action="{{ route('prebuy', ['stock_symbol' => $stock->stock_symbol]) }}" method="POST" class="h-full w-full">
                    @csrf
                    <input type="hidden" name="stock_symbol" value="{{ $stock->stock_symbol }}">
                    <button type="submit" class="py-4 text-3xl bg-green-400 hover:bg-green-700 w-full text-white text-center content-center rounded-xl">BUY</button>
                </form>
            </div>
        </div>
    </div>
@endsection
