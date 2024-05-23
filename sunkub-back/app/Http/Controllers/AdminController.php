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

        $userId = Auth::id();


        $admin = DB::table('admins')->where('id', $userId)->first();
        $sectors = DB::table('sectors')->get();
        $stocks = DB::table('stocks')->get();

        return view('admin', [
            'admin' => $admin,
        ], compact('sectors', 'stocks'));
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

    public function showBroker(Request $request)
    {
        $admin = $request->user();
    
        $brokers = DB::table('brokers')->get();
    
        return view('admin_pages.admin_manage_broker', compact('admin', 'brokers'));
    }
    

    public function pageaddbroker(Request $request)
    {
        $admin = $request->user();
        $sectors = DB::table('sectors')->get();
        $stocks = DB::table('stocks')->get();

        return view('admin_pages.add_broker',compact('admin','sectors', 'stocks'));
    }

    public function addbroker(Request $request)
    {
        $request->validate([
            'broker_name' => 'required|string|max:255',
            'broker_mail' => 'required|string|email|max:255',
            'broker_contact' => 'required|string|max:255',
            'stock_symbol.*' => 'nullable|string|max:10',
            'stock_name.*' => 'nullable|string|max:255',
            'stock_current_price.*' => 'nullable|numeric',
            'stock_sector_id.*' => 'nullable|exists:sectors,sector_id',
            'new_sector_name' => 'nullable|array',
            'new_sector_name.*' => 'nullable|string|max:255' // Allow array for multiple sectors
        ]);

        $broker_id = DB::table('brokers')->insertGetId([
            'broker_name' => $request->broker_name,
            'broker_mail' => $request->broker_mail,
            'broker_contact' => $request->broker_contact,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Process new sectors and existing sectors
        $newSectorIds = [];
        if (!empty($request->new_sector_name)) {
            foreach ($request->new_sector_name as $idx => $newSectorName) {
                if (!empty($newSectorName)) {
                    $existingSector = DB::table('sectors')->where('sector_name', $newSectorName)->first();

                    if (!$existingSector) {
                        $newSectorId = DB::table('sectors')->insertGetId([
                            'sector_name' => $newSectorName,
                        ]);
                    } else {
                        $newSectorId = $existingSector->sector_id;
                    }

                    $newSectorIds[$idx] = $newSectorId;
                }
            }
        }

        // Insert stocks
        if ($request->has('stock_symbol')) {
            foreach ($request->stock_symbol as $idx => $symbol) {
                if (isset($request->stock_sector_id[$idx])) {
                    $sector_id = $request->stock_sector_id[$idx];

                    // Use new sector ID if applicable
                    if (isset($request->sector_choice[$idx]) && $request->sector_choice[$idx] === 'new' && isset($newSectorIds[$idx])) {
                        $sector_id = $newSectorIds[$idx];
                    }

                    DB::table('stocks')->insert([
                        'stock_symbol' => $symbol,
                        'sector_id' => $sector_id,
                        'stock_name' => $request->stock_name[$idx],
                        'stock_current_price' => $request->stock_current_price[$idx],
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);

                    DB::table('view_stocks')->insert([
                        'stock_symbol' => $symbol,
                        'broker_id' => $broker_id,
                    ]);
                }
            }
        }

        // Insert selected stocks
        $selectedStocks = $request->input('selected_stocks');
        if ($selectedStocks) {
            foreach ($selectedStocks as $selectedStock) {
                DB::table('view_stocks')->insert([
                    'stock_symbol' => $selectedStock,
                    'broker_id' => $broker_id,
                ]);
            }
        }

        return redirect()->route('admin.showbroker');
    }

    public function showTakecarebroker(Request $request)
    {
        $admin = $request->user();
    
        $brokers = DB::table('brokers')
            ->join('view_admins', 'view_admins.broker_id', '=', 'brokers.broker_id')
            ->where('view_admins.admin_id',$admin->id)->get();
    
        $userCount = DB::table('ports')
            ->join('view_admins', 'ports.broker_id', '=', 'view_admins.broker_id')
            ->where('view_admins.admin_id', $admin->id)
            ->select('ports.broker_id', DB::raw('count(*) as user_count'))
            ->groupBy('ports.broker_id')
            ->get();

        return view('admin_pages.admin_takecare_broker',[
            'user_counts' => $userCount,
        ], compact('admin', 'brokers'));

    }
}
