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
            CURLOPT_URL => "https://alpha-vantage.p.rapidapi.com/query?interval=60min&function=TIME_SERIES_INTRADAY&symbol=$stock_name&datatype=json&output_size=compact",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "X-RapidAPI-Host: alpha-vantage.p.rapidapi.com",
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
            CURLOPT_URL => "https://alpha-vantage.p.rapidapi.com/query?interval=60min&function=TIME_SERIES_INTRADAY&symbol=$stock_name&datatype=json&output_size=compact",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "X-RapidAPI-Host: alpha-vantage.p.rapidapi.com",
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

            // Access time series data
            $time_series = $data['Time Series (60min)'];

            foreach ($time_series as $timestamp => $values) {
                // Extract relevant data
                $open = $values['1. open'];
                $high = $values['2. high'];
                $low = $values['3. low'];
                $close = $values['4. close'];
                $volume = $values['5. volume'];

                // Insert data into database
                // Assuming you have established a connection to your database
                // and have a $pdo object available
                DB::table('stock_prices')->insert([
                    'stock_id' => $id,
                    'stockp_open' => $open,
                    'stockp_high' => $high,
                    'stockp_low' => $low,
                    'stockp_close' => $close,
                    'volume' => $volume,
                    'created_at' => $timestamp,
                    'updated_at' => now()
                ]);
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
