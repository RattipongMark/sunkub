<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

class AdminController extends Controller
{
    public function index(Request $request): View
    {
        $userId = Auth::id();

        // Fetch the user details from the database using the query builder
        $user = DB::table('users')->where('id', $userId)->first();

        return view('real_pages/guess_landing', [
            'user' => $user,
        ]);
    }

    public function adminindex(Request $request): View
    {
        // Get the currently authenticated user's ID
        $userId = Auth::id();

        // Fetch the user details from the database using the query builder
        $admin = DB::table('admins')->where('id', $userId)->first();
        $sectors = DB::table('sectors')->get();
        $stocks = DB::table('stocks')->get();
        // Pass the user details to the view
        return view('admin', [
            'admin' => $admin,
        ],compact('sectors', 'stocks'));
    }


    public function addstock($request)
    {
        $request->validate([
            "stock_symbol" => "required",
            "sector_id" => "required",
            "stock_name" => "required",
        ]);

        $insertData = [
            'stock_symbol' => $request['stock_shortname'],
            'sector_id' => $request['sector_id'],
            'stock_name' => $request['stock_name'],
        ];

        DB::table('stocks')->insert($insertData);
    }

    public function addstockbroke($request)
    {
        $request->validate([
            "stock_symbol" => "required",
            "broker_id" => "required",
        ]);

        $insertData = [
            'stock_symbol' => $request['stock_id'],
            'broker_id' => $request['broker_id'],
        ];

        DB::table('view_stocks')->insert($insertData);
    }
    // แสดงฟอร์มการเพิ่ม broker, sector และ stock
    public function create()
    {
 
    }



public function store(Request $request)
{
    // Validate the request
    $request->validate([
        'broker_name' => 'required|string|max:255',
        'broker_mail' => 'required|string|email|max:255',
        'broker_contact' => 'required|string|max:255',
        'stock_symbol.*' => 'nullable|string|max:10',
        'stock_name.*' => 'nullable|string|max:255',
        'stock_current_price.*' => 'nullable|numeric',
        'stock_sector_id.*' => 'nullable|exists:sectors,sector_id'
    ]);

    // Create a new Broker
    $broker_id = DB::table('brokers')->insertGetId([
        'broker_name' => $request->broker_name,
        'broker_mail' => $request->broker_mail,
        'broker_contact' => $request->broker_contact,
        'created_at' => now(),
        'updated_at' => now()
    ]);

    // Insert stocks
    if ($request->has('stock_symbol')) {
        foreach ($request->stock_symbol as $key => $symbol) {
            DB::table('stocks')->insert([
                'stock_symbol' => $symbol,
                'sector_id' => $request->stock_sector_id[$key],
                'stock_name' => $request->stock_name[$key],
                'stock_current_price' => $request->stock_current_price[$key],
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // Insert data into view_stocks table
            $insertData = [
                'stock_symbol' => $symbol,
                'broker_id' => $broker_id,
            ];

            DB::table('view_stocks')->insert($insertData);
        }
    }

    $selectedStocks = $request->input('selected_stocks');

    // ตรวจสอบว่ามีการเลือกหุ้นหรือไม่
    if ($selectedStocks) {
        // ในกรณีที่มีการเลือกหุ้น
        foreach ($selectedStocks as $selectedStock) {
            // ทำการเพิ่มข้อมูลลงในตาราง stocks โดยใช้คำสั่ง SQL INSERT
            $insertData = [
                'stock_symbol' =>  $selectedStock,
                'broker_id' => $broker_id,
            ];

            DB::table('view_stocks')->insert($insertData);
        }
    }
    // Return success message as JSON
    return response()->json(['success' => 'Broker, Sector and Stock added successfully!']);
}

    
}
