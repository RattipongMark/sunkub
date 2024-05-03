<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PortController extends Controller
{
    function login(){
        return view('loginport');
    }

    public function checkPort(Request $request)
{
    // ตรวจสอบว่ามีข้อมูล user_broker และ password หรือไม่
    if (!$request->has(['user_broker', 'password'])) {
        return response()->json(['message' => 'Missing required parameters'], 400);
    }

    // ดึงข้อมูลจาก request
    $user_broker = $request->input('user_broker');
    $password = $request->input('password');

    // ค้นหา Port จากข้อมูลที่รับมา
    $port = DB::table('ports')
                ->where('user_broker', $user_broker)
                ->where('password', $password)
                ->first();

    // ตรวจสอบว่าพอร์ตพบหรือไม่
    if ($port) {
        // หากพอร์ตพบ ให้ดึงข้อมูลของผู้ใช้จากตาราง users ด้วย user_id
        $user = DB::table('users')->find($port->user_id);

        // ตรวจสอบว่าพบข้อมูลผู้ใช้หรือไม่
        if ($user) {
            // ส่งข้อมูลพอร์ตและข้อมูลผู้ใช้ไปยังหน้า myport
            return view('myport', compact('port', 'user'));
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    } else {
        return response()->json(['message' => 'Port does not exist'], 404);
    }
}



}
