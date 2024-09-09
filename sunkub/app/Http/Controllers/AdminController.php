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
    public function index1(Request $request)
    {
        $user =$request->user();
        return view('real_pages/guess_landing', [
            'user' => $user,
        ]);
    }

    public function admindasboard(Request $request): View
    {
        $admin = $request->user();

        $adminId = $admin->id;

        // SELECT  brokers.broker_name, 
        //         SUM(buys.volume) AS total_volume
        // FROM buys
        // JOIN stock_prices ON buys.stockp_id = stock_prices.stockp_id
        // JOIN ports ON buys.port_id = ports.port_id
        // JOIN brokers ON ports.broker_id = brokers.broker_id
        // JOIN view_admins ON brokers.broker_id = view_admins.broker_id
        // WHERE view_admins.admin_id = $adminId
        // GROUP BY brokers.broker_name
        // ORDER BY total_volume DESC
        // LIMIT 3;
        $brokbuymost = DB::table('buys')
            ->join('stock_prices', 'buys.stockp_id', '=', 'stock_prices.stockp_id')
            ->join('ports', 'buys.port_id', '=', 'ports.port_id')
            ->join('brokers', 'ports.broker_id', '=', 'brokers.broker_id')
            ->join('view_admins', 'brokers.broker_id', '=', 'view_admins.broker_id')
            ->select('brokers.broker_name', DB::raw('SUM(buys.volume) as total_volume'))
            ->where('view_admins.admin_id', $adminId)
            ->groupBy('brokers.broker_name')
            ->orderByDesc('total_volume')
            ->take(3)
            ->get();


        // SELECT  brokers.broker_name, 
        //         SUM(sells.volume) AS total_volume
        // FROM sells
        // JOIN stock_prices ON sells.stockp_id = stock_prices.stockp_id
        // JOIN ports ON sells.port_id = ports.port_id
        // JOIN brokers ON ports.broker_id = brokers.broker_id
        // JOIN view_admins ON brokers.broker_id = view_admins.broker_id
        // WHERE view_admins.admin_id = $adminId
        // GROUP BY brokers.broker_name
        // ORDER BY total_volume DESC
        // LIMIT 3;     
        $broksellmost = DB::table('sells')
            ->join('stock_prices', 'sells.stockp_id', '=', 'stock_prices.stockp_id')
            ->join('ports', 'sells.port_id', '=', 'ports.port_id')
            ->join('brokers', 'ports.broker_id', '=', 'brokers.broker_id')
            ->join('view_admins', 'brokers.broker_id', '=', 'view_admins.broker_id')
            ->select('brokers.broker_name', DB::raw('SUM(sells.volume) as total_volume'))
            ->where('view_admins.admin_id', $adminId)
            ->groupBy('brokers.broker_name')
            ->orderByDesc('total_volume')
            ->take(3)
            ->get();


        // SELECT  sectors.sector_name, 
        //         SUM(buys.volume) AS total_volume
        // FROM buys
        // JOIN stock_prices ON buys.stockp_id = stock_prices.stockp_id
        // JOIN stocks ON stock_prices.stock_symbol = stocks.stock_symbol
        // JOIN sectors ON stocks.sector_id = sectors.sector_id
        // JOIN ports ON buys.port_id = ports.port_id
        // JOIN brokers ON ports.broker_id = brokers.broker_id
        // JOIN view_admins ON brokers.broker_id = view_admins.broker_id
        // WHERE view_admins.admin_id = $adminId
        // GROUP BY sectors.sector_name
        // ORDER BY total_volume ASC
        // LIMIT 3;     
        $sectorbuymost = DB::table('buys')
            ->join('stock_prices', 'buys.stockp_id', '=', 'stock_prices.stockp_id')
            ->join('stocks', 'stock_prices.stock_symbol', '=', 'stocks.stock_symbol')
            ->join('sectors', 'stocks.sector_id', '=', 'sectors.sector_id')
            ->join('ports', 'buys.port_id', '=', 'ports.port_id')
            ->join('brokers', 'ports.broker_id', '=', 'brokers.broker_id')
            ->join('view_admins', 'brokers.broker_id', '=', 'view_admins.broker_id')
            ->select('sectors.sector_name', DB::raw('SUM(buys.volume) as total_volume'))
            ->where('view_admins.admin_id', $adminId)
            ->groupBy('sectors.sector_name')
            ->orderBy('total_volume')
            ->take(3)
            ->get();

        $totalVolumesectorbuymost = 0;
        foreach ($sectorbuymost as $sector) {
            $totalVolumesectorbuymost += $sector->total_volume;
        }
        $percentagebuy = [];
        foreach ($sectorbuymost as $sector) {
            $percentagebuy[$sector->sector_name] = ($sector->total_volume / $totalVolumesectorbuymost) * 100;
        }
        

        // SELECT  sectors.sector_name, 
        //         SUM(sells.volume) AS total_volume
        // FROM sells
        // JOIN stock_prices ON sells.stockp_id = stock_prices.stockp_id
        // JOIN stocks ON stock_prices.stock_symbol = stocks.stock_symbol
        // JOIN sectors ON stocks.sector_id = sectors.sector_id
        // JOIN ports ON sells.port_id = ports.port_id
        // JOIN brokers ON ports.broker_id = brokers.broker_id
        // JOIN view_admins ON brokers.broker_id = view_admins.broker_id
        // WHERE view_admins.admin_id = $adminId
        // GROUP BY sectors.sector_name
        // ORDER BY total_volume ASC
        // LIMIT 3; 
        $sectorsellmost = DB::table('sells')
            ->join('stock_prices', 'sells.stockp_id', '=', 'stock_prices.stockp_id')
            ->join('stocks', 'stock_prices.stock_symbol', '=', 'stocks.stock_symbol')
            ->join('sectors', 'stocks.sector_id', '=', 'sectors.sector_id')
            ->join('ports', 'sells.port_id', '=', 'ports.port_id')
            ->join('brokers', 'ports.broker_id', '=', 'brokers.broker_id')
            ->join('view_admins', 'brokers.broker_id', '=', 'view_admins.broker_id')
            ->select('sectors.sector_name', DB::raw('SUM(sells.volume) as total_volume'))
            ->where('view_admins.admin_id', $adminId)
            ->groupBy('sectors.sector_name')
            ->orderBy('total_volume')
            ->take(3)
            ->get();

        $totalVolumesectorsellmost = 0;
        foreach ($sectorsellmost as $sector) {
            $totalVolumesectorsellmost += $sector->total_volume;
        }
        $percentagesell = [];
        foreach ($sectorsellmost as $sector) {
            $percentagesell[$sector->sector_name] = ($sector->total_volume / $totalVolumesectorsellmost) * 100;
        }

        return view('admin_pages.admin_dashboard', [
            'topbuybroker' => $brokbuymost,
            'topsellbroker' => $broksellmost,
            'topbuysec' => $sectorbuymost,
            'topsellsec' => $sectorsellmost,
            'percenbuy' => $percentagebuy,
            'percensell' => $percentagesell,
        ], compact('admin'));
    }

    public function buythemost(Request $request)
    {
        $admin = $request->user();

        $adminId = $admin->id;


        // SELECT  brokers.broker_name, 
        //         stock_prices.stock_symbol, 
        //         SUM(buys.volume) AS total_volume
        // FROM buys
        // JOIN stock_prices ON buys.stockp_id = stock_prices.stockp_id
        // JOIN ports ON buys.port_id = ports.port_id
        // JOIN brokers ON ports.broker_id = brokers.broker_id
        // JOIN view_admins ON brokers.broker_id = view_admins.broker_id
        // WHERE view_admins.admin_id = $adminId
        // GROUP BY brokers.broker_name, stock_prices.stock_symbol
        // ORDER BY brokers.broker_name ASC, total_volume DESC; 
        $results = DB::table('buys')
            ->join('stock_prices', 'buys.stockp_id', '=', 'stock_prices.stockp_id')
            ->join('ports', 'buys.port_id', '=', 'ports.port_id')
            ->join('brokers', 'ports.broker_id', '=', 'brokers.broker_id')
            ->join('view_admins', 'brokers.broker_id', '=', 'view_admins.broker_id')
            ->select('brokers.broker_name', 'stock_prices.stock_symbol', DB::raw('SUM(buys.volume) as total_volume'))
            ->where('view_admins.admin_id', $adminId)
            ->groupBy('brokers.broker_name', 'stock_prices.stock_symbol')
            ->orderBy('brokers.broker_name')
            ->orderByDesc('total_volume')
            ->get();
        $rankedResults = [];
        foreach ($results as $result) {
            if (!isset($rankedResults[$result->broker_name])) {
                $rankedResults[$result->broker_name] = [];
            }
            if (count($rankedResults[$result->broker_name]) < 3) {
                $rankedResults[$result->broker_name][] = $result;
            }
        }

        return view('admin_pages.admin_buythemost_broker', compact('admin', 'rankedResults'));
    }


    public function sellthemost(Request $request)
    {
        $admin = $request->user();

        $adminId = $admin->id;


        // SELECT  brokers.broker_name, 
        //         stock_prices.stock_symbol, 
        //         SUM(sells.volume) AS total_volume
        // FROM sells
        // JOIN stock_prices ON sells.stockp_id = stock_prices.stockp_id
        // JOIN ports ON sells.port_id = ports.port_id
        // JOIN brokers ON ports.broker_id = brokers.broker_id
        // JOIN view_admins ON brokers.broker_id = view_admins.broker_id
        // WHERE view_admins.admin_id = $adminId
        // GROUP BY brokers.broker_name, stock_prices.stock_symbol
        // ORDER BY brokers.broker_name ASC, total_volume DESC;
        $results = DB::table('sells')
            ->join('stock_prices', 'sells.stockp_id', '=', 'stock_prices.stockp_id')
            ->join('ports', 'sells.port_id', '=', 'ports.port_id')
            ->join('brokers', 'ports.broker_id', '=', 'brokers.broker_id')
            ->join('view_admins', 'brokers.broker_id', '=', 'view_admins.broker_id')
            ->select('brokers.broker_name', 'stock_prices.stock_symbol', DB::raw('SUM(sells.volume) as total_volume'))
            ->where('view_admins.admin_id', $adminId)
            ->groupBy('brokers.broker_name', 'stock_prices.stock_symbol')
            ->orderBy('brokers.broker_name')
            ->orderByDesc('total_volume')
            ->get();
        $rankedResults = [];
        foreach ($results as $result) {
            if (!isset($rankedResults[$result->broker_name])) {
                $rankedResults[$result->broker_name] = [];
            }
            if (count($rankedResults[$result->broker_name]) < 3) {
                $rankedResults[$result->broker_name][] = $result;
            }
        }

        return view('admin_pages.admin_sellthemost_broker', compact('admin', 'rankedResults'));
    }

    public function adminsectorbuy(Request $request) {
        $admin = $request->user();

        $adminId = $admin->id;

        // SELECT  brokers.broker_name, 
        //         sectors.sector_name, 
        //         SUM(buys.volume) AS total_volume
        // FROM buys
        // JOIN stock_prices ON buys.stockp_id = stock_prices.stockp_id
        // JOIN stocks ON stock_prices.stock_symbol = stocks.stock_symbol
        // JOIN sectors ON stocks.sector_id = sectors.sector_id
        // JOIN ports ON buys.port_id = ports.port_id
        // JOIN brokers ON ports.broker_id = brokers.broker_id
        // JOIN view_admins ON brokers.broker_id = view_admins.broker_id
        // WHERE view_admins.admin_id = $adminId
        // GROUP BY brokers.broker_name, sectors.sector_name
        // ORDER BY brokers.broker_name ASC, total_volume DESC; 
        $results = DB::table('buys')
            ->join('stock_prices', 'buys.stockp_id', '=', 'stock_prices.stockp_id')
            ->join('stocks', 'stock_prices.stock_symbol', '=', 'stocks.stock_symbol')
            ->join('sectors', 'stocks.sector_id', '=', 'sectors.sector_id')
            ->join('ports', 'buys.port_id', '=', 'ports.port_id')
            ->join('brokers', 'ports.broker_id', '=', 'brokers.broker_id')
            ->join('view_admins', 'brokers.broker_id', '=', 'view_admins.broker_id')
            ->select('brokers.broker_name', 'sectors.sector_name', DB::raw('SUM(buys.volume) as total_volume'))
            ->where('view_admins.admin_id', $adminId)
            ->groupBy('brokers.broker_name', 'sectors.sector_name')
            ->orderBy('brokers.broker_name')
            ->orderByDesc('total_volume')
            ->get();

        $rankedResults = [];
        foreach ($results as $result) {
            if (!isset($rankedResults[$result->broker_name])) {
                $rankedResults[$result->broker_name] = [];
            }
            if (count($rankedResults[$result->broker_name]) < 3) {
                $rankedResults[$result->broker_name][] = $result;
            }
        }

        return view('admin_pages.admin_buythemost_sector', compact('admin', 'rankedResults'));
    }

    public function adminsectorsell(Request $request) {
        $admin = $request->user();

        $adminId = $admin->id;

        // SELECT  brokers.broker_name, 
        //         sectors.sector_name, 
        //         SUM(sells.volume) AS total_volume
        // FROM sells
        // JOIN stock_prices ON sells.stockp_id = stock_prices.stockp_id
        // JOIN stocks ON stock_prices.stock_symbol = stocks.stock_symbol
        // JOIN sectors ON stocks.sector_id = sectors.sector_id
        // JOIN ports ON sells.port_id = ports.port_id
        // JOIN brokers ON ports.broker_id = brokers.broker_id
        // JOIN view_admins ON brokers.broker_id = view_admins.broker_id
        // WHERE view_admins.admin_id = $adminId
        // GROUP BY brokers.broker_name, sectors.sector_name
        // ORDER BY brokers.broker_name ASC, total_volume DESC;
        $results = DB::table('sells')
            ->join('stock_prices', 'sells.stockp_id', '=', 'stock_prices.stockp_id')
            ->join('stocks', 'stock_prices.stock_symbol', '=', 'stocks.stock_symbol')
            ->join('sectors', 'stocks.sector_id', '=', 'sectors.sector_id')
            ->join('ports', 'sells.port_id', '=', 'ports.port_id')
            ->join('brokers', 'ports.broker_id', '=', 'brokers.broker_id')
            ->join('view_admins', 'brokers.broker_id', '=', 'view_admins.broker_id')
            ->select('brokers.broker_name', 'sectors.sector_name', DB::raw('SUM(sells.volume) as total_volume'))
            ->where('view_admins.admin_id', $adminId)
            ->groupBy('brokers.broker_name', 'sectors.sector_name')
            ->orderBy('brokers.broker_name')
            ->orderByDesc('total_volume')
            ->get();

        $rankedResults = [];
        foreach ($results as $result) {
            if (!isset($rankedResults[$result->broker_name])) {
                $rankedResults[$result->broker_name] = [];
            }
            if (count($rankedResults[$result->broker_name]) < 3) {
                $rankedResults[$result->broker_name][] = $result;
            }
        }

        return view('admin_pages.admin_sellthemost_sector', compact('admin', 'rankedResults'));
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

        return view('admin_pages.add_broker', compact('admin', 'sectors', 'stocks'));
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


        // INSERT INTO brokers (broker_name, broker_mail, broker_contact, created_at, updated_at)
        // VALUES ('value_for_broker_name', 'value_for_broker_mail', 'value_for_broker_contact', 'current_timestamp', 'current_timestamp');
        /* ---------- */
        // SELECT LAST_INSERT_ID();        
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
                    // SELECT * FROM sectors WHERE sector_name = 'new_sector_name' LIMIT 1;
                    $existingSector = DB::table('sectors')->where('sector_name', $newSectorName)->first();

                    if (!$existingSector) {

                        // INSERT INTO sectors (sector_name) VALUES ('new_sector_name');
                        // SELECT LAST_INSERT_ID();
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

                    // INSERT INTO stocks (stock_symbol, sector_id, stock_name, stock_current_price, created_at, updated_at)
                    // VALUES ('symbol_value', sector_id_value, 'stock_name_value', stock_current_price_value, 'current_timestamp', 'current_timestamp');                    
                    DB::table('stocks')->insert([
                        'stock_symbol' => $symbol,
                        'sector_id' => $sector_id,
                        'stock_name' => $request->stock_name[$idx],
                        'stock_current_price' => $request->stock_current_price[$idx],
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);


                    // INSERT INTO view_stocks (stock_symbol, broker_id)
                    // VALUES ('symbol_value', broker_id_value);                    
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

    public function showstock(Request $request)
    {
        $admin = $request->user();

        // SELECT * FROM stocks ORDER BY created_at;
        $stocks = DB::table('stocks')->orderBy('created_at')->get();

        return view('admin_pages.admin_stockmanage', compact('admin', 'stocks'));
    }

    public function pageaddstock(Request $request)
    {
        $admin = $request->user();
        $sectors = DB::table('sectors')->get();
        $stocks = DB::table('stocks')->get();

        return view('admin_pages.add_stock', compact('admin', 'sectors', 'stocks'));
    }

    public function addstock(Request $request)
    {
        $request->validate([
            'stock_symbol.*' => 'nullable|string|max:10',
            'stock_name.*' => 'nullable|string|max:255',
            'stock_current_price.*' => 'nullable|numeric',
            'stock_sector_id.*' => 'nullable|exists:sectors,sector_id',
            'new_sector_name' => 'nullable|array',
            'new_sector_name.*' => 'nullable|string|max:255' // Allow array for multiple sectors
        ]);


        // Process new sectors and existing sectors
        $newSectorIds = [];
        if (!empty($request->new_sector_name)) {
            foreach ($request->new_sector_name as $idx => $newSectorName) {
                if (!empty($newSectorName)) {
                    // SELECT * FROM sectors WHERE sector_name = 'new_sector_name' LIMIT 1;
                    $existingSector = DB::table('sectors')->where('sector_name', $newSectorName)->first();

                    if (!$existingSector) {

                        // INSERT INTO sectors (sector_name) VALUES ('new_sector_name');
                        // SELECT LAST_INSERT_ID();                        
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

                    // INSERT INTO stocks (stock_symbol, sector_id, stock_name, stock_current_price, created_at, updated_at)
                    // VALUES ('symbol_value', sector_id_value, 'stock_name_value', stock_current_price_value, 'current_timestamp', 'current_timestamp');
                    DB::table('stocks')->insert([
                        'stock_symbol' => $symbol,
                        'sector_id' => $sector_id,
                        'stock_name' => $request->stock_name[$idx],
                        'stock_current_price' => $request->stock_current_price[$idx],
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }
        }


        return redirect()->route('admin.showstock');
    }

    public function showTakecarebroker(Request $request)
    {
        $admin = $request->user();


        // SELECT * 
        // FROM brokers 
        // JOIN view_admins ON view_admins.broker_id = brokers.broker_id 
        // WHERE view_admins.admin_id = $admin->id;        
        $brokers = DB::table('brokers')
            ->join('view_admins', 'view_admins.broker_id', '=', 'brokers.broker_id')
            ->where('view_admins.admin_id', $admin->id)->get();


        // SELECT ports.broker_id, COUNT(*) as user_count
        // FROM ports
        // JOIN view_admins ON ports.broker_id = view_admins.broker_id
        // WHERE view_admins.admin_id = $admin->id
        // GROUP BY ports.broker_id;    
        $userCount = DB::table('ports')
            ->join('view_admins', 'ports.broker_id', '=', 'view_admins.broker_id')
            ->where('view_admins.admin_id', $admin->id)
            ->select('ports.broker_id', DB::raw('count(*) as user_count'))
            ->groupBy('ports.broker_id')
            ->get();

        return view('admin_pages.admin_takecare_broker', [
            'user_counts' => $userCount,
        ], compact('admin', 'brokers'));
    }
}
