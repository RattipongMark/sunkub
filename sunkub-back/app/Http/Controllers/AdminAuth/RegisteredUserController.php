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
        ]);


        $user = DB::table('admins')->insert([
            'fname' => $request['fname'],
            'lname' => $request['lname'],
            'gender' => $request['gender'],
            'dob' => $request['dob'],
            'email' => $request['email'],
            'tel' => $request['tel'],
            'password' => Hash::make($request['password']),
        ]);

        // Retrieve the inserted admin by email
        $admin = DB::table('admins')->where('email', $request['email'])->first();

        if ($admin) {
            // Fire the Registered event
            event(new Registered($admin));

            // Manually log in the admin using the retrieved data
            Auth::guard('admin')->loginUsingId($admin->id);

            return redirect(RouteServiceProvider::ADMIN_DASHBOARD);
        }

        return back()->withErrors(['error' => 'Failed to create admin.']);
    }
}
