<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        //<?php
        $stock = DB::table('stocks')->where('stock_id',$id)->first();
        if ($stock) {
            $stock_name = $stock->stock_shortname;
        } else {
            echo 'not have stock';
        }
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://financial-modeling-prep.p.rapidapi.com/v3/stock/real-time-price/$stock_name",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "X-RapidAPI-Host: financial-modeling-prep.p.rapidapi.com",
                "X-RapidAPI-Key: 603a5298f7msh1d4c377949e7da9p1c42eajsn2979467f5b1e"
            ],
        ]);
        
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($id)
    {
        $stock = DB::table('stocks')->where('stock_id',$id)->first();
        
        if ($stock) {
            $stock_name = $stock->stock_shortname;
        } else {
            echo 'not have stock';
        }

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://financial-modeling-prep.p.rapidapi.com/v3/stock/real-time-price/$stock_name",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "X-RapidAPI-Host: financial-modeling-prep.p.rapidapi.com",
                "X-RapidAPI-Key: 603a5298f7msh1d4c377949e7da9p1c42eajsn2979467f5b1e"
            ],
        ]);
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
            echo "cURL Error #:" . $err;
        } 
        else{
            $data = json_decode($response, true);

            foreach ($data['companiesPriceList'] as $company) {
                $insertData = [
                    'stock_id' => $id,
                    'stockp_close' => $company['price'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                
                DB::table('stock_prices')->insert($insertData);

                $updateData = [
                    'stock_current_price' => $company['price'],
                    'stock_current_price' => $company['price'],
                    'updated_at' => now(),
                ];
                DB::table('stocks')->where('stock_id',$id)->update($updateData);
                break;
            }
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $data = now();
        echo "a".$data;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
