 @extends('real_components/navbar')

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
                                    <input  id="user_broker" placeholder="Username" class="input input-bordered input-md w-full max-w-xs" type="text" name="user_broker" :value="old('user_broker')" />
                                    <x-input-error :messages="$errors->get('user_broker')" class="mt-2" />
                                </div>
                            </div>
                            <div class="grid grid-cols-4 pt-12 pl-12 pr-12">
                                <div class="items-center"><img src="{{url('images/pass.svg')}}" alt=""></div>
                                <div class="items-center col-span-3">
                                    <input placeholder="Password" class="input input-bordered input-md w-full max-w-xs"
                                        type="password"
                                        name="password"
                                        required autocomplete="current-password"
                                     />
                                     <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>
                            </div>
                            <div class="pt-12 pl-12 pr-12">
                                <button class="btn btn-purple w-full" width="100%">Button</button>
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