 @extends('real_components/navbarguess')

@section('css')
    <link rel="stylesheet" href="/css/login.css">
@endsection

@section('title')
    Login
@endsection

{{-- <form action="{{ route('checkPort') }}" method="POST">
    @csrf
    <label for="user_broker">User Broker:</label><br>
    <input type="text" id="user_broker" name="user_broker"><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password"><br><br>
    <button type="submit">Login</button>
</form> --}}


@section('content')
    <div class="bglogin">
        <div class="pt-24">
            <form method="POST" action="{{ route('checkPort') }}">
                @csrf
                <div class="grid grid-row-2 place-items-center">
                    <div class="place-items-center pb-8 headtext">เข้าสู่ Portfolio</div>
                    <div class="logincard ">
                        <div class="grid grid-row-4">
                            <div class="grid grid-cols-4 pt-12 pl-12 pr-12">
                                <div class="items-center"><img src="{{url('images/user.svg')}}" alt=""></div>
                                <div class="items-center col-span-3">
                                    <input  id="user_broker" placeholder="Username" class="mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="user_broker" :value="old('user_broker')" />
                                    <x-input-error :messages="$errors->get('user_broker')" class="mt-2" />
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
                                <button class="btn btn-purple w-full" width="100%">เข้าสู่พอร์ต</button>
                            </div>
                            <div class="pt-12 pl-12 pr-12 text-red-400 text-center">
                                <div class="text-sm">กรณีไม่มีบัญชี กรุณาสมัคร ณ ตลาดหลักทรัพย์ที่ให้บริการ</div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection