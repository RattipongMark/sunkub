@extends('real_components/sidebar_admin')
@php
    $admin = new stdClass();
    $admin->fname = 'Sun';
    $color = ['bg-gray-800', 'bg-gray-600'];
@endphp
@section('css')
    <link rel="stylesheet" href="/css/user.css">
    @vite('resources/css/app.css')
@endsection

@section('title')
    Admin Stock
@endsection

@section('contentnav')
    ภาพรวม Stock
@endsection

@section('content')
    <div class="flex flex-row justfify-between">
        <div class="flex-1">
            <div class="text-white text-3xl font-bold pt-6 pl-5">
                การจัดการ Stock
            </div>
            <div class="text-white pt-2 pl-5 opacity-75">
                แก้ไข Stock ในรายการ
            </div>
        </div>
    </div>

    <div class="grid grid-cols-3 h-full mx-16 gap-4 my-8">
        @foreach ($stocks as $stock)
            <div class="">

                <!-- Card Component -->
                <div class=" grid gird-rows-2 bg-zinc-800 text-white h-56 w-full rounded-xl shadow-lg px-8 py-8 ">
                    <div class="self-center text-7xl font-bold text-green-400 text-center">
                        {{ $stock->stock_symbol }}
                    </div>
                    <div class="self-end text-xl text-gray-400 text-end">
                        {{ $stock->stock_name }}
                    </div>

                </div>
            </div>
        @endforeach
        <a href="/admin/addstock">
            <div class="h-56 w-full flex justify-center rounded-xl px-8 py-8 border-dashed border-4 border-neutral-500 ">
                <img src="{{ url('images/PlusCircle.svg') }}" alt="" width="30%">
            </div>
        </a>
    </div>
@endsection
