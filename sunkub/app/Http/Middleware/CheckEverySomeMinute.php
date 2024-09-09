<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckEverySomeMinute
{
    // public function handle($request, Closure $next)
    // {
    //     // ตรวจสอบว่ามีการเรียกใช้งาน Route ภายใน 5 นาทีที่ผ่านมาหรือไม่
    //     if (!Cache::has('route.lastCalled') || Cache::get('route.lastCalled') < now()->subMinutes(5)) {
    //         // บันทึกเวลาที่เรียกใช้งาน Route ล่าสุด
    //         Cache::put('route.lastCalled', now());
    //         // ให้ผ่านไปยัง Route ต่อไป
    //         return $next($request);
    //     }

    //     // ถ้าเวลาผ่านไปน้อยกว่า 5 นาที ส่งคืน Response ว่า Too Many Requests
    //     return response()->json(['message' => 'Too many requests.'], 429);
    // }
}
