@extends('real_components/sidebar')

@section('css')
    <link rel="stylesheet" href="/css/user.css">
    @vite('resources/css/app.css')
@endsection

@section('title')
    deposit
@endsection

@section('contentnav')
    กระเป๋าตังค์
@endsection

@section('content')
    <div class="bg-neutral-700 m-5 rounded-xl h-full">
        <div class="pt-3 ml-4">
            <a href=""><img src="images/backArrow.svg" class="size-6"></a>
        </div>

        <form action="" method="POST">
            @csrf
            <div class="mx-5 mt-4 min-h-dvh h-auto">
                <div class="ml-3">
                    <div class="text-3xl text-white">
                        การฝากเงิน
                    </div>
                    <div class="text-base mt-2 text-thin text-gray-200">
                        ข้อมูลที่แสดงคำสั่งฝากเงินของคุณ
                    </div>
                    <div class="bg-zinc-800 rounded-xl flex flex-col items-center p-5 mt-3 mr-5">
                        <select class="select text-center text-opacity-50 w-full max-w-xs text-black bg-white"
                            id="card-select">
                            <option disabled selected>เลือกบัตรเครดิต</option>
                            @foreach($paymentMethods as $paymentMethod)
                                <option value="{{ $paymentMethod->paymentmethod_id }}">{{ $paymentMethod->paymentmethod_name }}</option>
                            @endforeach
                            
                            <option value="sunkukcard">sunkukcard</option>
                            <option value="add-new-card">เพิ่มบัตรเครดิต</option>
                        </select>
                    </div>
                    <div id="add-card-form" style="display:none;">
                        <div class="bg-zinc-800 rounded-xl flex flex-col items-center p-5 mt-3 mr-5">
                            <div class="flex justify-center py-4 gap-3">
                                <img src="{{ url('images/front_card.svg') }}" alt="">
                                <img src="{{ url('images/rear_card.svg') }}" alt="">
                            </div>
                            <div class="text-white text-left w-1/2">เลขบัตรของคุณ</div>
                            <label class="input input-bordered flex items-center gap-2 bg-white mt-2 w-1/2">
                                <input type="text" class="grow bg-white" placeholder="xxxx xxxx xxxx xxxx"
                                    id="paymentmethod_id" />
                            </label>
                            <div class="text-white text-left w-7/12 mt-2">ชื่อเจ้าของบัตร</div>
                            <div class="grid grid-cols-2 gap-2 w-7/12">
                                <label class="input input-bordered flex items-center gap-2 bg-white mt-2">
                                    <input type="text" class="grow bg-white" placeholder="ชื่อ"
                                        id="paymentmethod_fname" />
                                </label>
                                <label class="input input-bordered flex items-center gap-2 bg-white mt-2">
                                    <input type="text" class="grow bg-white" placeholder="นามสกุล"
                                        id="paymentmethod_lname" />
                                </label>
                            </div>
                            <div class="grid grid-cols-2 mt-2 w-1/2 gap-40">
                                <div class="text-white text-left">วันหมดอายุ</div>
                                <div class="text-white text-left">CVV / CVC</div>
                            </div>
                            <div class="grid grid-cols-3 mt-2 gap-2 w-1/2">
                                <label class="input input-bordered flex items-center gap-2 bg-white">
                                    <input type="text" class="grow bg-white w-1/2" placeholder="xx" id="EXP_month" />
                                </label>
                                <label class="input input-bordered flex items-center gap-2 bg-white">
                                    <input type="text" class="grow bg-white w-1/2" placeholder="xx" id="EXP_year" />
                                </label>
                                <label class="input input-bordered flex items-center gap-2 bg-white">
                                    <input type="text" class="grow bg-white w-1/2" placeholder="xxx" id="CVV_CVC" />
                                </label>
                            </div>
                        </div>
                    </div>
                    <div id="deposit-form" style="display:none;">
                        <div class="bg-zinc-800 rounded-xl flex flex-col items-center p-5 mt-3 mr-5">
                            <div class="flex justify-center py-4 gap-3">
                                <img src="{{ url('images/front_card.svg') }}" alt="">
                                <img src="{{ url('images/rear_card.svg') }}" alt="">
                            </div>
                            <div class="flex flex-col items-center">
                                <div class="text-white text-left mt-2">CVV / CVC</div>
                                <label class="input input-bordered flex items-center gap-2 bg-white mt-2 w-3/5">
                                    <input type="text" class="grow bg-white w-3/5" placeholder="xxx" id="CVV_CVC" />
                                </label>
                            </div>
                        </div>
                    </div>
                    <div id="amount-form" style="display:none;">
                        <div class="bg-zinc-800 rounded-xl flex flex-col items-center p-5 mb-5 mt-3 mr-5">
                            <div class="bg-white rounded-xl w-3/4 p-3">
                                <div class="text-black text-opacity-50 text-xl text-center">
                                    เลือกพอร์ตโฟลิโอของคุณ
                                </div>
                            </div>
                            <div
                                class="border-dashed border-l-2 border-r-2 border-b-2 border-white border-opacity-50 rounded-b-xl p-4 w-3/5">
                                <div class="flex flex-col">
                                    <div class="bg-violet-400 rounded-xl p-3 mt-2 mb-2">
                                        <div class="grid grid-cols-3">
                                            <div class="text-white text-lg col-span-1">
                                                Portfolio 1
                                            </div>
                                            <div class="flex flex-row items-center justify-end col-span-2">
                                                <div class="text-white text-sm mr-3">
                                                    ยอดเงินปัจจุบัน 5,000 บาท
                                                </div>
                                                <input type="checkbox" class="checkbox checkbox-bg-white border-black"
                                                    onchange="toggleInput(this, 'portfolio-1-input')" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-center mb-2" id="portfolio-1-input"
                                        style="display:none;">
                                        <div class="text-white text-left w-3/4">
                                            จำนวนเงิน
                                        </div>
                                        <label class="input input-bordered flex items-center gap-2 bg-white mt-2 w-3/4">
                                            <input type="text" class="grow bg-white text-sm"
                                                placeholder="ใส่จำนวนเงินที่คุณต้องการฝาก" />
                                            <div class="text-black text-sm opacity-40">บาท</div>
                                        </label>
                                    </div>
                                    <div class="bg-violet-400 rounded-xl p-3 mt-2 mb-2">
                                        <div class="grid grid-cols-3">
                                            <div class="text-white text-lg col-span-1">
                                                Portfolio 2
                                            </div>
                                            <div class="flex flex-row items-center justify-end col-span-2">
                                                <div class="text-white text-sm mr-3">
                                                    ยอดเงินปัจจุบัน 3,000 บาท
                                                </div>
                                                <input type="checkbox" class="checkbox border-black"
                                                    onchange="toggleInput(this, 'portfolio-2-input')" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-center mb-2" id="portfolio-2-input"
                                        style="display:none;">
                                        <div class="text-white text-left w-3/4">
                                            จำนวนเงิน
                                        </div>
                                        <label class="input input-bordered flex items-center gap-2 bg-white mt-2 w-3/4">
                                            <input type="text" class="grow bg-white text-sm"
                                                placeholder="ใส่จำนวนเงินที่คุณต้องการฝาก" />
                                            <div class="text-black text-sm opacity-40">บาท</div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-end mt-4 w-3/5">
                                <a href=""
                                    class="bg-violet-300 mb-3 rounded-xl hover:bg-violet-400 p-2 text-lg text-black">ชำระเงิน</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        document.getElementById('card-select').addEventListener('change', function() {
            var addCard = document.getElementById('add-card-form');
            var deposit = document.getElementById('deposit-form');
            var amount = document.getElementById('amount-form');

            addCard.style.display = 'none';
            deposit.style.display = 'none';
            amount.style.display = 'none';

            if (this.value === 'add-new-card') {
                addCard.style.display = 'block';
                amount.style.display = 'block';
            } else {
                deposit.style.display = 'block';
                amount.style.display = 'block';
            }
        });

        function toggleInput(checkbox, inputId) {
            var inputDiv = document.getElementById(inputId);
            if (checkbox.checked) {
                inputDiv.style.display = 'flex';
            } else {
                inputDiv.style.display = 'none';
            }
        }
    </script>
@endsection
