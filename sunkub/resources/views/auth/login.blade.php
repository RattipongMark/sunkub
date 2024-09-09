@extends('real_components/navbar')

@section('css')
    <link rel="stylesheet" href="/css/login.css">
@endsection

@section('title')
    Login
@endsection

@section('content')
    <div class="bglogin">
        <div class="grid grid-cols-2 pt-28 place-items-center">
            <div class="pt-20 place-items-center">
                <img src="{{url('images/konuser.svg')}}" alt="">
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="grid grid-row-2 place-items-center">
                    <div class="place-items-center pb-8 headtext">เข้าสู่ระบบ</div>
                    <div class="logincard ">
                        <div class="grid grid-row-4">
                            <div class="grid grid-cols-4 pt-12 pl-12 pr-12">
                                <div class="items-center"><img src="{{url('images/user.svg')}}" alt=""></div>
                                <div class="items-center col-span-3">
                                    <input  id="email" placeholder="Email" class="mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="email" name="email" :value="old('email')" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                            </div>
                            <div class="grid grid-cols-4 pt-12 pl-12 pr-12">
                                <div class="items-center"><img src="{{url('images/pass.svg')}}" alt=""></div>
                                <div class="items-center col-span-3">
                                    <input placeholder="Password" class="mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        type="password"
                                        name="password"
                                        required autocomplete="current-password"
                                     />
                                     <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>
                            </div>
                            <div class="pt-12 pl-12 pr-12">
                                <button class="btn btn-purple w-full" width="100%">Login</button>
                            </div>
                            <div class="grid grid-cols-3 pt-12 pl-12 pr-12 ">
                                <div class="flex-none white200">หากยังไม่มีบัญชี</div>
                                <div class="flex-none flex ">
                                    <a href="/register">
                                        <div class="purple100 items-center link-purple">สมัครได้ที่นี่</div>
                                    </a>
                                    <img src="images/ArrowCircleRight.svg" alt="" width="20%" class="link-img">
                                </div>
                                <div class="flex justify-end white200 link-white">ลืมรหัสผ่าน</div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
           
        </div>
    </div>
@endsection