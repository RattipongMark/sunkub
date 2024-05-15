@extends('real_components/navbarguess')

@section('title')
    Welcome
@endsection

@section('content')
    
    <div class="guess_land1 ">
        <div class="grid grid-rows-3 gap-4">
            <div class="pt-80">
                
                <div class="flex justify-center pt-14">
                    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active" data-bs-interval="5000">
                                <div class="flex  gap-14">
                                    <!-- TradingView Widget BEGIN -->
                                    <div class="tradingview-widget-container rounded-lg">
                                        <div class="tradingview-widget-container__widget rounded-lg"></div>
                                        <script class="rounded-lg" type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-mini-symbol-overview.js"
                                            async>
                                            {
                                                "symbol": "NASDAQ:AAPL",
                                                "width": 400,
                                                "height": "250",
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
                                                "width": 400,
                                                "height": "250",
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
                                                "width": 400,
                                                "height": "250",
                                                "locale": "en",
                                                "dateRange": "1D",
                                                "colorTheme": "dark",
                                                "isTransparent": false,
                                                "autosize": false,
                                                "largeChartUrl": ""
                                            }
                                        </script>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item" data-bs-interval="5000">
                                <div class="flex gap-14">

                                    <div class="tradingview-widget-container">
                                        <div class="tradingview-widget-container__widget"></div>
                                        
                                        <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-mini-symbol-overview.js"
                                            async>
                                            {
                                                "symbol": "NASDAQ:NVDA",
                                                "width": "400",
                                                "height": "250",
                                                "locale": "en",
                                                "dateRange": "1D",
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
                                                "symbol": "NASDAQ:AMD",
                                                "width": "400",
                                                "height": "250",
                                                "locale": "en",
                                                "dateRange": "1D",
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
                                                "symbol": "NASDAQ:INTC",
                                                "width": "400",
                                                "height": "250",
                                                "locale": "en",
                                                "dateRange": "1D",
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
                            <div class="carousel-item">
                                <div class="flex gap-14">
                                    <!-- TradingView Widget BEGIN -->
                                    <div class="tradingview-widget-container">
                                        <div class="tradingview-widget-container__widget"></div>
                                        
                                        <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-mini-symbol-overview.js"
                                            async>
                                            {
                                                "symbol": "NASDAQ:AMZN",
                                                "width": "400",
                                                "height": "250",
                                                "locale": "en",
                                                "dateRange": "1D",
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
                                                "width": "400",
                                                "height": "250",
                                                "locale": "en",
                                                "dateRange": "1D",
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
                                                "symbol": "NASDAQ:NFLX",
                                                "width": "400",
                                                "height": "250",
                                                "locale": "en",
                                                "dateRange": "1D",
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

            </div>
            <div class=" pt-8 grid justify-items-center">
                <div> <!-- TradingView Widget BEGIN -->
                    <div class="tradingview-widget-container">
                        <div class="tradingview-widget-container__widget"></div>
                        <div class="tradingview-widget-copyright"><a href="https://th.tradingview.com/"
                                rel="noopener nofollow" target="_blank"><span class="white200">ติดตามตลาดทั้งหมดได้บน
                                    TradingView</span></a></div>
                        <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-advanced-chart.js" async>
                            {
                                "width": "1310",
                                "height": "500",
                                "symbol": "NASDAQ:GOOG",
                                "interval": "D",
                                "timezone": "Etc/UTC",
                                "theme": "dark",
                                "style": "1",
                                "locale": "th_TH",
                                "enable_publishing": false,
                                "hide_side_toolbar": false,
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
            <div class="pl-28 pt-80">
                <a href="/loginport">
                    <div>
                        <img src="{{ url('images/btnland.svg') }}" class="btn-land" alt="">
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection

{{-- --}}
