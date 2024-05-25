{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Stock</title>
</head>
<body>
    <h1>ซื้อหุ้น</h1>
    <form action="{{ route('sell', ['stock_symbol' => $stock->stock_symbol]) }}" method="POST">
        @csrf
        <input type="hidden" name="stock_symbol" value="{{ $stock->stock_symbol }}">
        
        
        <label for="volume">จำนวนหุ้นที่ต้องการขาย:</label>
        <input type="text" id="volume" name="volume" required><br><br>
        
        <button type="submit">ขาย</button>
    </form>
</body>
</html> --}}
@extends('real_components.sidebar')

@section('css')
    <link rel="stylesheet" href="/css/user.css">
    @vite('resources/css/app.css')
@endsection

@section('title')
    Sell
@endsection

@section('contentnav')
    ตลาดหุ้น
@endsection

@section('content')
    <div class="cardliststock mx-8 mt-8 flex flex-col h-screen px-4 ">
        <form action="{{ route('poststock', ['stock_symbol' => $stock->stock_symbol]) }}" method="GET">
            @csrf
            <button type="submit" class="pt-3"><img src="/images/ArrowLeft.svg" alt=""></button>
        </form>
        <div class="ml-3">
            <div class=" text-3xl text-white">
                คำสั่งการขายของคุณ
            </div>
            <div class="text-base mt-2 text-thin text-gray-200 opacity-75">
                ข้อมูลที่แสดงคำสั่งการขายหุ้นของคุณ
            </div>
        </div>

        <div class="bg-zinc-800 mt-3 rounded-t-xl h-screen px-5 pt-4">
            <form action="{{ route('sell', ['stock_symbol' => $stock->stock_symbol]) }}" method="POST">
                @csrf
                <input type="hidden" name="stock_symbol" value="{{ $stock->stock_symbol }}">
                <div class="text-white text-base opacity-50">{{ $stock->stock_name }}</div>
                <div class="flex justify-between items-center">
                    <div class="text-6xl text-violet-400 mt-2">{{ $stock->stock_symbol }}</div>
                    <div>
                        <div class="text-white opacity-50">ราคาปัจจุบัน</div>
                        <div class="text-white text-xl mt-2 text-center">{{ $stock->stock_current_price }} USD</div>
                    </div>
                </div>
                <div class="text-white mt-10">จำนวนหุ้นที่ต้องการขาย</div>
                <label class="input input-bordered flex items-center gap-2 bg-white mt-4">
                    <input type="text" class="grow bg-white" placeholder="ใส่จำนวนหุ้นที่ต้องการซื้อ" id="volume"
                        name="volume">
                    <div class="text-black opacity-50">หุ้น</div>
                </label>
                <div id="volume-error" class="text-red-400 mt-4 w-full text-right"></div>
                <div class="grid grid-cols-2 mt-4">
                    <div class="text-lg text-white mt-1">
                       ยอดเงินทั้งหมดที่จะได้รับ :
                    </div>
                    <div class="text-white text-3xl flex justify-end" id="total-cost">
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                document.getElementById('volume').addEventListener('input', function() {
                                    var currentPrice = parseFloat("{{ $stock->stock_current_price }}");
                                    var volume = parseFloat(document.getElementById('volume').value);
                                    if (isNaN(volume)) {
                                        document.getElementById('total-cost').textContent = '0.00 USD';
                                    } else {
                                        var totalCost = currentPrice * volume;
                                        document.getElementById('total-cost').textContent = totalCost.toFixed(2) + ' USD';
                                        document.getElementById('order-summary').textContent =
                                            "คำสั่งการขายของคุณคือ {{ $stock->stock_symbol }} จำนวน " + volume +
                                            " หุ้น ที่ราคา " + totalCost.toFixed(2) + " USD";
                                    }
                                });
                                document.getElementById('close-modal').addEventListener('click', function() {
                                    document.getElementById('my_modal_1').close();
                                });
                                document.getElementById('volume').addEventListener('input', function() {
                                    var volumeInput = document.getElementById('volume').value;
                                    var isNumeric = !isNaN(volumeInput) && volumeInput !== "" && volumeInput > 0;

                                    if (isNumeric) {
                                        // แสดงปุ่ม "Buy" เมื่อจำนวนหุ้นเป็นตัวเลขที่มากกว่า 0
                                        document.getElementById('buy-button').disabled = false;
                                        document.getElementById('volume-error').textContent = ""; // ล้างข้อความเตือน
                                    } else {
                                        // ซ่อนปุ่ม "Buy" เมื่อจำนวนหุ้นไม่ถูกต้อง
                                        document.getElementById('buy-button').disabled = true;
                                        document.getElementById('volume-error').textContent =
                                        "กรุณากรอกจำนวนหุ้นให้ถูกต้อง"; // แสดงข้อความเตือน
                                    }
                                });
                            });
                        </script>
                    </div>
                </div>
                <div class="mt-2">
                    <div class="flex justify-end"><img src="{{ url('images/checkCircle.svg') }}">
                        <p class="text-green-400 text-lg ml-1"> ไม่มีค่าธรรมเนียม</p>
                    </div>
                </div>
                <div class="flex justify-end mt-14">
                    <button id="buy-button" type="button" onclick="my_modal_1.showModal()"
                        class="text-white text-xl bg-red-500 px-4 py-2 rounded-xl hover:bg-purple-200 w-36 h-14"
                        disabled>Sell</button>
                    <dialog id="my_modal_1" class="modal">
                        <div class="modal-box">
                            <h3 class="font-bold text-lg text-white">โปรดยืนยันคำสั่งการขายอีกครั้ง</h3>
                            <p id="order-summary" class="py-4 text-white">คำสั่งการขายของคุณคือ {{ $stock->stock_symbol }} จำนวน 0
                                หุ้น
                                ที่ราคา 0.00 USD</p>
                            <div class="modal-action">
                                <button id="close-modal" class="btn btn-danger" type="button">ยกเลิก</button>
                                <button type="submit" class="btn btn-success text-white">ยืนยัน</button>
                            </div>
                        </div>
                    </dialog>
                </div>
            </form>
        </div>
    </div>
@endsection
