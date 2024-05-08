<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Broker;
use Illuminate\Support\Facades\DB;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $brokers = DB::select('SELECT * FROM brokers');
        return view('admin.auth.admin_register', compact('brokers'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            "fname" => "required",
            "lname" => "required",
            "gender" => "required",
            "dob" => "required",
            "email" => "required|email|unique:users",
            "tel" => "required",
            "password" => "required|confirmed",
            "broker_id" => "required", 
        ]);
        

        $user = Admin::create([
            'fname' => $request['fname'],
            'lname' => $request['lname'],
            'gender' => $request['gender'],
            'dob' => $request['dob'],
            'email' => $request['email'],
            'tel' => $request['tel'],
            'password' => Hash::make($request['password']),
        ]);


        DB::table('view_admins')->insert([
            'broker_id' => $request['broker_id'],
            'admin_id' => $user->id,
        ]);


        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::ADMIN_DASHBOARD);
    }
}
