@extends('real_components.sidebar')

@section('css')
    <link rel="stylesheet" href="/css/user.css">
    @vite('resources/css/app.css')
@endsection


@section('title')
    Deposit Confirmation
@endsection

@section('contentnav')
    กระเป๋าตังค์
@endsection
@php
    $sum = 0;
    $cash = [2000, 3000, 5000];
@endphp
@section('content')
<script>
    // รับข้อมูลจาก URL query string
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);

    // ดึงข้อมูลจาก query string
    const cardNumber = urlParams.get('card_number');
    const firstName = urlParams.get('first_name');
    const lastName = urlParams.get('last_name');
    const expiryMonth = urlParams.get('expiry_month');
    const expiryYear = urlParams.get('expiry_year');
    const cvv = urlParams.get('cvv');
    const portIds = urlParams.getAll('port_ids[]');
    const portAmounts = urlParams.getAll('port_amounts[]');

    // แสดงข้อมูลใน HTML
    document.getElementById('cardNumber').innerHTML = `<p>เลขบัตร: ${cardNumber}</p>`;
    document.getElementById('fullName').innerHTML = `<p>ชื่อ: ${firstName} ${lastName}</p>`;
    document.getElementById('expiryDate').innerHTML = `<p>วันหมดอายุ: ${expiryMonth}/${expiryYear}</p>`;
    document.getElementById('cvv').innerHTML = `<p>CVV/CVC: ${cvv}</p>`;

    let portfoliosHTML = '';
    for (let i = 0; i < portIds.length; i++) {
        portfoliosHTML += `<li>Portfolio ID: ${portIds[i]}, จำนวนเงิน: ${portAmounts[i]} บาท</li>`;
    }
    document.getElementById('portfolios').innerHTML = portfoliosHTML;
</script>

    <div class="bg-neutral-700 m-5 rounded-xl h-full min-h-dvh">
        <div class="pt-3 ml-4">
            <a href=""><img src="images/backArrow.svg" class="size-6"></a>
        </div>
        <div class="grid grid-row-2 mx-5 mt-4">
            <div class="ml-3">
                <div class=" text-3xl text-white">
                    ยืนยันคำสั่งการฝากเงิน
                </div>
                <div class="text-base mt-2 text-thin text-gray-200 ">
                    ข้อมูลที่แสดงรายละเอียดคำสั่งฝากเงินของคุณ
                </div>
            </div>
            <div class="bg-zinc-800 mt-3 rounded-xl  grid grid-rows-3 ">
                <div class="px-8 pt-4">
                    <p class="text-white text-base px-3">ชื่อบัญชี</p>
                    <div class="text-violet-400 text-xl px-3" id="cardNumber"></div>
                    <p class="mt-9 text-white px-3">วันที่ส่งคำสั่ง : 10/20/30 - 20:30</p>
                    <hr class="border-white mt-4 border-solid border-1">
                </div>
                <div class="px-8">
                    <p class="text-white px-3">ข้อมูลการฝากเงิน :</p>
                    @for ($i = 1; $i <= 3; $i++)
                        <div class="grid grid-cols-2 mt-4 px-9">
                            <p class="text-violet-400 "><span style="color:#a78bfa ">พอร์ตโฟลิโอ {{ $i }} <span
                                        style="color:white ">ฝากเงินเข้าเป็นจำนวน</p>
                            <p class="text-white flex justify-end">${portAmounts[i]} บาท</p>
                        </div>
                        @php
                            $sum += $cash[$i - 1];
                        @endphp
                    @endfor
                    <hr class="border-white mt-4 border-solid border-1">
                </div>
                <div>
                    <div class="grid grid-cols-2 px-8 mt-3">
                        <p class="text-white text-base px-3 pt-1">ยอดเงินทั้งหมดที่จะทำการฝาก :</p>
                        <p class="text-white text-3xl flex justify-end pr-3">{{ $sum }} บาท</p>
                    </div>
                    <p class="text-green-400 text-base flex justify-end px-11 mt-1">ไม่มีค่าธรรมเนียม</p>
                    <div class="flex justify-end px-11">
                        <button
                            class="bg-violet-300 mt-10 rounded-xl text-neutral-800 hover:bg-violet-400 py-2 px-4 ">ยืนยันการชำระเงิน</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
