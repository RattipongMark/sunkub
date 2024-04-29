<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MyNewCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'app:my-new-command';
    protected $signature = 'auto:cron';

   
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
      call('App\Http\Controllers\StockController@store')->everyFiveMinutes();  
 
    }
}
