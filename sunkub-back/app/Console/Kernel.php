<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Http\Controllers\StockController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */

    

    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            $idList = DB::table('stocks')->pluck('stock_id');// Example list of stock IDs
      
            foreach ($idList as $id) {
                
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
                    'updated_at' => now(),
                ];
                DB::table('stocks')->where('stock_id',$id)->update($updateData);
                break;
            }
            }
            }
        })->everyFiveMinutes(); 
    }
    
    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
    protected $commands = [            
        Commands\MyNewCommand::class
    ];
}
