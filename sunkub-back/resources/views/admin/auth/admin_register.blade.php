@extends('real_components/navbaradmin')

@section('css')
    <link rel="stylesheet" href="/css/regist.css">
@endsection

@section('title')
    Register
@endsection

@section('content')
    <div class="bgregist">
        <div class="flex flex-col items-center justify-center px-6  mx-auto md:h-screen lg:py-10">
            <h1 href="#" class="flex items-center mb-6 text-5xl font-semibold text-gray-900 dark:text-white">
                ลงทะเบียน Admin
            </h1>
            <div class=" logincard ">
                <div class="p-8 space-y-10 md:space-y-10 sm:p-10">
                    <form method="POST" action="{{ route('admin.register') }}">
                        @csrf
                        <div class="grid gap-4 ">
                        <!-- Name -->
                        <div>
                            <label for="first_name"
                                    class="block mb-2 text-sm font-medium text-white">First name</label>
                            <x-text-input id="fname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="fname" :value="old('fname')" required autofocus autocomplete="fname" />
                            <x-input-error :messages="$errors->get('fname')" class="mt-2" />
                        </div>
                
                        <!-- Name -->
                        <div>
                            <label for="last_name"
                                    class="block mb-2 text-sm font-medium text-white">Last name</label>
                            <x-text-input id="lname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="lname" :value="old('lname')" required autofocus autocomplete="lname" />
                            <x-input-error :messages="$errors->get('lname')" class="mt-2" />
                        </div>
                
                        <div>
                            <label for="gender"
                                    class="block mb-2 text-sm font-medium text-white">Gender</label>
                            <select id="gender" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="gender" required>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                        </div>
                        
                        <!-- Date of Birth -->
                        <div>
                            <label for="DOB"
                                    class="block mb-2 text-sm font-medium text-white">Date Of
                                    Birth</label>
                            <x-text-input id="dob" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="date" name="dob" :value="old('dob')" required />
                            <x-input-error :messages="$errors->get('dob')" class="mt-2" />
                        </div>
                
                        <!-- Email Address -->
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-white">Email
                                address</label>
                            <x-text-input id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="email" name="email" :value="old('email')" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                
                        <div>
                            <label for="phone"
                            class="block mb-2 text-sm font-medium text-white">Phone
                            number</label>
                            <x-text-input id="tel" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="tel" :value="old('tel')" required autofocus autocomplete="tel" />
                            <x-input-error :messages="$errors->get('tel')" class="mt-2" />
                        </div>
                
                        <!-- Password -->
                        <div class="col-span-2">
                            <label for="password"
                            class="block mb-2 text-sm font-medium text-white">Password</label>
                
                            <x-text-input id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            type="password"
                                            name="password"
                                            required autocomplete="new-password" />
                
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                
                        <!-- Confirm Password -->
                        <div class="col-span-2">
                            <label for="password_confirmation"
                            class="block mb-2 text-sm font-medium text-white">Confirm
                            password</label>
                
                            <x-text-input id="password_confirmation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            type="password"
                                            name="password_confirmation" required autocomplete="new-password" />
                
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                
                        <div class="flex items-center justify-end mt-4 col-span-2">
                            <a class="underline text-sm text-white hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('admin.login') }}">
                                {{ __('Already registered?') }}
                            </a>
                
                            <x-primary-button class="ms-4 bg-purple-400">
                                {{ __('Register') }}
                            </x-primary-button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
