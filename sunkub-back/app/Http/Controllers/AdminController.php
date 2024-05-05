<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;


class AdminController extends Controller
{
    public function index(Request $request): View
    {
        return view('real_pages/guess_landing', [
            'user' => $request->user(),
        ]);
    }


    public function addstock($request){
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

    public function addstockbroke($request){
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
}
