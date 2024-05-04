<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function addstock($request){
        $request->validate([
            "sector_id" => "required",
            "stock_shortname" => "required",
            "stock_name" => "required",
        ]);

        $insertData = [
            'sector_id' => $request['sector_id'],
            'stock_shortname' => $request['stock_shortname'],
            'stock_name' => $request['stock_name'],
        ];

        DB::table('stocks')->insert($insertData);
    }

    public function addstockbroke($request){
        $request->validate([
            "stock_id" => "required",
            "broker_id" => "required",
        ]);

        $insertData = [
            'stock_id' => $request['stock_id'],
            'broker_id' => $request['broker_id'],
        ];

        DB::table('view_stocks')->insert($insertData);
    }
}
