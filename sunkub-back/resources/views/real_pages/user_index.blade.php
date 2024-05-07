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

@section('content')

    <div class="guess_index1">
        <form action="/stock" method="GET">
            @csrf
            <div class="pt-32 pr-8 flex justify-end">
                <button type="submit" class="btn bg-purple-500 w-36 text-white">ลงทุนเลย</button>
            </div>
        </form>
    </div>
    <div class="grid justify-items-center pt-8">
        <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="10000">
                    <div class="flex gap-4">
                        <div class="tradingview-widget-container rounded-lg">
                            <div class="tradingview-widget-container__widget rounded-lg"></div>
                            <script class="rounded-lg" type="text/javascript"
                                src="https://s3.tradingview.com/external-embedding/embed-widget-mini-symbol-overview.js" async>
                                {
                                    "symbol": "NASDAQ:AAPL",
                                    "width": 200,
                                    "height": "150",
                                    "locale": "en",
                                    "dateRange": "1D",
                                    "colorTheme": "dark",
                                    "isTransparent": false,
                                    "autosize": false,
                                    "largeChartUrl": ""
                                }
                            </script>
                        </div>
                        <div class="tradingview-widget-container">
                            <div class="tradingview-widget-container__widget"></div>
                            <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-mini-symbol-overview.js"
                                async>
                                {
                                    "symbol": "NASDAQ:TSLA",
                                    "width": 200,
                                    "height": "150",
                                    "locale": "en",
                                    "dateRange": "1D",
                                    "colorTheme": "dark",
                                    "isTransparent": false,
                                    "autosize": false,
                                    "largeChartUrl": ""
                                }
                            </script>
                        </div>
                        <div class="tradingview-widget-container">
                            <div class="tradingview-widget-container__widget"></div>
                            <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-mini-symbol-overview.js"
                                async>
                                {
                                    "symbol": "NASDAQ:META",
                                    "width": 200,
                                    "height": "150",
                                    "locale": "en",
                                    "dateRange": "1D",
                                    "colorTheme": "dark",
                                    "isTransparent": false,
                                    "autosize": false,
                                    "largeChartUrl": ""
                                }
                            </script>
                        </div>
                        <!-- TradingView Widget BEGIN -->
                        <div class="tradingview-widget-container">
                            <div class="tradingview-widget-container__widget"></div>
                            <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-mini-symbol-overview.js"
                                async>
                                {
                                    "symbol": "NASDAQ:AMZN",
                                    "width": "200",
                                    "height": "150",
                                    "locale": "en",
                                    "dateRange": "12M",
                                    "colorTheme": "dark",
                                    "isTransparent": false,
                                    "autosize": false,
                                    "largeChartUrl": ""
                                }
                            </script>
                        </div>
                        <!-- TradingView Widget END -->
                        <!-- TradingView Widget BEGIN -->
                        <div class="tradingview-widget-container">
                            <div class="tradingview-widget-container__widget"></div>
                            
                            <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-mini-symbol-overview.js"
                                async>
                                {
                                    "symbol": "NASDAQ:MSFT",
                                    "width": "200",
                                    "height": "150",
                                    "locale": "en",
                                    "dateRange": "12M",
                                    "colorTheme": "dark",
                                    "isTransparent": false,
                                    "autosize": false,
                                    "largeChartUrl": ""
                                }
                            </script>
                        </div>
                        <!-- TradingView Widget END -->
                    </div>
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                </div>
                <div class="carousel-item">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <div class="cardstock pt-4 grid justify-items-center">
        <div> <!-- TradingView Widget BEGIN -->
            <div class="tradingview-widget-container">
                <div class="tradingview-widget-container__widget"></div>
                <div class="tradingview-widget-copyright"><a href="https://th.tradingview.com/"
                        rel="noopener nofollow" target="_blank"><span class="white200">ติดตามตลาดทั้งหมดได้บน
                            TradingView</span></a></div>
                <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-advanced-chart.js" async>
                    {
                        "width": "1100",
                        "height": "500",
                        "symbol": "NASDAQ:GOOG",
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
        </div>
    </div>
@endsection
