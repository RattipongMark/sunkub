<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PortController extends Controller
{

    public function login(Request $request)
    {
        return view('real_pages/loginport', [
            'user' => $request->user(),
        ]);
    }


    public function checkPort(Request $request)
    {
        if (!$request->has(['user_broker', 'password'])) {
            return response()->json(['message' => 'Missing required parameters'], 400);
        }

        $user_broker = $request->input('user_broker');
        $password = $request->input('password');


        // "select * from `ports` where `user_broker` = $user_broker and `password` = $password"
        $port = DB::table('ports')
            ->where('user_broker', $user_broker)
            ->where('password', $password)
            ->first();

        if ($port) {
            $user_check = DB::table('users')->find($port->user_id);
            $user = $request->user();
            if ($user->id == $user_check->id) {
                $request->session()->put('port', $port);
                $request->session()->put('user', $user);
                return view('real_pages/user_index', compact('port', 'user'));
            } else {
                return response()->json(['message' => 'User not found'], 404);
            }
        } else {
            return response()->json(['message' => 'Port does not exist'], 404);
        }
    }

    public function menu1(Request $request)
    {
        $port = $request->session()->get('port');
        $user = $request->session()->get('user');


        return view('real_pages/user_index', compact('port', 'user'));
    }

    public function dashboard(Request $request)
    {
        $port = $request->session()->get('port');
        $user = $request->session()->get('user');
        $port->balance = DB::table('ports')->where('port_id', $port->port_id)->value('balance');

        // SELECT SUM(buys.volume * stock_prices.stockp_close) AS total
        // FROM buys
        // JOIN stock_prices ON buys.stockp_id = stock_prices.stockp_id
        // WHERE buys.port_id = $port->port_id;
        $total_buy = DB::table('buys')
            ->join('stock_prices', 'buys.stockp_id', '=', 'stock_prices.stockp_id')
            ->where('buys.port_id', $port->port_id)
            ->sum(DB::raw('buys.volume * stock_prices.stockp_close'));


        // SELECT SUM(buys.volume * stock_prices.stockp_close)
        // FROM buys
        // JOIN stock_prices ON buys.stockp_id = stock_prices.stockp_id
        // JOIN ports ON buys.port_id = ports.port_id
        // WHERE ports.user_id = $port->user_id;
        $total_invest = DB::table('buys')
            ->join('stock_prices', 'buys.stockp_id', '=', 'stock_prices.stockp_id')
            ->join('ports', 'buys.port_id', '=', 'ports.port_id')
            ->where('ports.user_id', $port->user_id)
            ->sum(DB::raw('buys.volume * stock_prices.stockp_close'));

        
        // SELECT ports.port_id, brokers.broker_name, SUM(buys.volume * stock_prices.stockp_close) AS total_buy_amount
        // FROM buys
        // JOIN stock_prices ON buys.stockp_id = stock_prices.stockp_id
        // JOIN ports ON buys.port_id = ports.port_id
        // JOIN brokers ON ports.broker_id = brokers.broker_id
        // WHERE ports.user_id = $port->user_id
        // GROUP BY ports.port_id, brokers.broker_name;
        $total_buy_eachport = DB::table('buys')
            ->join('stock_prices', 'buys.stockp_id', '=', 'stock_prices.stockp_id')
            ->join('ports', 'buys.port_id', '=', 'ports.port_id')
            ->join('brokers', 'ports.broker_id', '=', 'brokers.broker_id')
            ->where('ports.user_id', $port->user_id)
            ->select('ports.port_id', 'brokers.broker_name', DB::raw('SUM(buys.volume * stock_prices.stockp_close) AS total_buy_amount'))
            ->groupBy('ports.port_id', 'brokers.broker_name')
            ->get();

        
        // SELECT stocks.stock_symbol, SUM(buys.volume * stock_prices.stockp_close) AS total_buy_amount
        // FROM buys
        // JOIN stock_prices ON buys.stockp_id = stock_prices.stockp_id
        // JOIN stocks ON stock_prices.stock_symbol = stocks.stock_symbol
        // JOIN ports ON buys.port_id = ports.port_id
        // WHERE ports.port_id = $port->port_id
        // GROUP BY stocks.stock_symbol
        // ORDER BY total_buy_amount DESC;
        $total_buy_eachport_by_stock = DB::table('buys')
            ->join('stock_prices', 'buys.stockp_id', '=', 'stock_prices.stockp_id')
            ->join('stocks', 'stock_prices.stock_symbol', '=', 'stocks.stock_symbol')
            ->join('ports', 'buys.port_id', '=', 'ports.port_id')
            ->where('ports.port_id', $port->port_id)
            ->select('stocks.stock_symbol', DB::raw('SUM(buys.volume * stock_prices.stockp_close) AS total_buy_amount'))
            ->groupBy('stocks.stock_symbol')
            ->orderBy('total_buy_amount', 'desc')
            ->get();

        $percentage = [];


        foreach ($total_buy_eachport_by_stock as $buy) {
            $temp = $total_buy_eachport->where('port_id', $port->port_id)->first();

            if ($temp && $temp->total_buy_amount != 0) {
                $percentage[$buy->stock_symbol] = ($buy->total_buy_amount / $temp->total_buy_amount) * 100;
            } else {
                $percentage[$buy->stock_symbol] = 0;
            }
        }

        // SELECT stocks.stock_symbol, 
        // SUM(buys.volume) AS total_buy_volume_stock
        // FROM buys
        // JOIN stock_prices ON buys.stockp_id = stock_prices.stockp_id
        // JOIN stocks ON stock_prices.stock_symbol = stocks.stock_symbol
        // WHERE buys.port_id = $port->port_id
        // GROUP BY stocks.stock_symbol
        // ORDER BY total_buy_volume_stock DESC;
        $total_buy_stock = DB::table('buys')
            ->join('stock_prices', 'buys.stockp_id', '=', 'stock_prices.stockp_id')
            ->join('stocks', 'stock_prices.stock_symbol', '=', 'stocks.stock_symbol')
            ->where('buys.port_id', $port->port_id)
            ->select('stocks.stock_symbol', DB::raw('SUM(buys.volume) AS total_buy_volume_stock'))
            ->groupBy('stocks.stock_symbol')
            ->orderBy('total_buy_volume_stock', 'desc')
            ->get();


        // SELECT stocks.stock_symbol, 
        // SUM(sells.volume) AS total_sell_volume_stock
        // FROM sells
        // JOIN stock_prices ON sells.stockp_id = stock_prices.stockp_id
        // JOIN stocks ON stock_prices.stock_symbol = stocks.stock_symbol
        // WHERE sells.port_id = $port->port_id
        // GROUP BY stocks.stock_symbol
        // ORDER BY total_sell_volume_stock DESC;
        $total_sell_stock = DB::table('sells')
            ->join('stock_prices', 'sells.stockp_id', '=', 'stock_prices.stockp_id')
            ->join('stocks', 'stock_prices.stock_symbol', '=', 'stocks.stock_symbol')
            ->where('sells.port_id', $port->port_id)
            ->select('stocks.stock_symbol', DB::raw('SUM(sells.volume) AS total_sell_volume_stock'))
            ->groupBy('stocks.stock_symbol')
            ->orderBy('total_sell_volume_stock', 'desc')
            ->get();


        // SELECT stocks.stock_symbol, 
        // AVG(stock_prices.stockp_close) AS average_buy_price
        // FROM buys
        // JOIN stock_prices ON buys.stockp_id = stock_prices.stockp_id
        // JOIN stocks ON stock_prices.stock_symbol = stocks.stock_symbol
        // WHERE buys.port_id = ?
        // GROUP BY stocks.stock_symbol
        // ORDER BY average_buy_price DESC     
        $total_average_buy_price = DB::table('buys')
            ->join('stock_prices', 'buys.stockp_id', '=', 'stock_prices.stockp_id')
            ->join('stocks', 'stock_prices.stock_symbol', '=', 'stocks.stock_symbol')
            ->where('buys.port_id', $port->port_id)
            ->select('stocks.stock_symbol', DB::raw('AVG(stock_prices.stockp_close) AS average_buy_price'))
            ->groupBy('stocks.stock_symbol')
            ->orderBy('average_buy_price', 'desc')
            ->get();

        $remaining_volume_eachstock = [];
        $total_profit = 0;
        $total_cost_stock = 0;
        foreach ($total_buy_stock as $buy_item) {
            $stock = $buy_item->stock_symbol;
            $buy_volume = $buy_item->total_buy_volume_stock;

            $sell_item = $total_sell_stock->where('stock_symbol', $stock)->first();
            $sell_volume = $sell_item ? $sell_item->total_sell_volume_stock : 0;
            $remaining_volume = $buy_volume - $sell_volume;

            $stockitem = DB::table('stocks')->where('stock_symbol', $stock)->first();
            $stockP = $stockitem->stock_current_price;

            $avgitem = $total_average_buy_price->where('stock_symbol', $stock)->first();
            $avgprice = $avgitem ? $avgitem->average_buy_price : 0;

            $cost_stock = $remaining_volume * $avgprice;
            $revenue = $remaining_volume * $stockP;
            $profit = $revenue - $cost_stock;


            $total_cost_stock += $cost_stock;
            $total_profit += $profit;

            $remaining_volume_eachstock[] = [
                'symbol' => $buy_item->stock_symbol,
                'remaining_volume' => $remaining_volume,
            ];
        }
        if($total_cost_stock != 0)
            $percen_profit = ($total_profit / $total_cost_stock) * 100;
        else
            $percen_profit = 0;
        return view('real_pages/user_dashboard', [
            'amountmoney' => $total_buy,
            'totalinvest' => $total_invest,
            'amountport' => $total_buy_eachport,
            'amountstock' =>  $total_buy_eachport_by_stock,
            'percen' => $percentage,
            'profit' => $total_profit,
            'percen_profit' => $percen_profit
        ], compact('port', 'user'));
    }

    public function portfolio(Request $request)
    {
        $port = $request->session()->get('port');
        $user = $request->session()->get('user');

        // SELECT  ports.port_id, 
        //         brokers.broker_name, 
        //         SUM(buys.volume) AS total_buy_volume
        // FROM buys
        // JOIN ports ON buys.port_id = ports.port_id
        // JOIN brokers ON ports.broker_id = brokers.broker_id
        // WHERE ports.user_id = $port->user_id
        // GROUP BY ports.port_id, brokers.broker_name;
        $total_buy_eachport = DB::table('buys')
            ->join('ports', 'buys.port_id', '=', 'ports.port_id')
            ->join('brokers', 'ports.broker_id', '=', 'brokers.broker_id')
            ->where('ports.user_id', $port->user_id)
            ->select('ports.port_id', 'brokers.broker_name', DB::raw('SUM(buys.volume) AS total_buy_volume'))
            ->groupBy('ports.port_id', 'brokers.broker_name')
            ->get();


        // SELECT  ports.port_id, 
        //         brokers.broker_name, 
        //         SUM(sells.volume) AS total_sell_volume
        // FROM sells
        // JOIN ports ON sells.port_id = ports.port_id
        // JOIN brokers ON ports.broker_id = brokers.broker_id
        // WHERE ports.user_id = $port->user_id
        // GROUP BY ports.port_id, brokers.broker_name;
        $total_sell_eachport = DB::table('sells')
            ->join('ports', 'sells.port_id', '=', 'ports.port_id')
            ->join('brokers', 'ports.broker_id', '=', 'brokers.broker_id')
            ->where('ports.user_id', $port->user_id)
            ->select('ports.port_id', 'brokers.broker_name', DB::raw('SUM(sells.volume) AS total_sell_volume'))
            ->groupBy('ports.port_id', 'brokers.broker_name')
            ->get();

        $remaining_volume_eachport = [];
        $remaining_volume_account = 0;
        foreach ($total_buy_eachport as $buy_item) {
            $port_id = $buy_item->port_id;
            $buy_volume = $buy_item->total_buy_volume;

            $sell_item = $total_sell_eachport->where('port_id', $port_id)->first();
            $sell_volume = $sell_item ? $sell_item->total_sell_volume : 0;

            $remaining_volume = $buy_volume - $sell_volume;
            $remaining_volume_account += $remaining_volume;
            $remaining_volume_eachport[] = [
                'port_id' => $port_id,
                'broker_name' => $buy_item->broker_name,
                'remaining_volume' => $remaining_volume,
            ];
        }

        $percentage = [];
        foreach ($remaining_volume_eachport as $buy) {
            $percentage[$buy['port_id']] = ($buy['remaining_volume'] / $remaining_volume_account) * 100;
        }


        // SELECT  stocks.stock_symbol, 
        //         SUM(buys.volume) AS total_buy_volume_stock
        // FROM buys
        // JOIN stock_prices ON buys.stockp_id = stock_prices.stockp_id
        // JOIN stocks ON stock_prices.stock_symbol = stocks.stock_symbol
        // WHERE buys.port_id = $port->port_id
        // GROUP BY stocks.stock_symbol
        // ORDER BY total_buy_volume_stock DESC;
        $total_buy_stock = DB::table('buys')
            ->join('stock_prices', 'buys.stockp_id', '=', 'stock_prices.stockp_id')
            ->join('stocks', 'stock_prices.stock_symbol', '=', 'stocks.stock_symbol')
            ->where('buys.port_id', $port->port_id)
            ->select('stocks.stock_symbol', DB::raw('SUM(buys.volume) AS total_buy_volume_stock'))
            ->groupBy('stocks.stock_symbol')
            ->orderBy('total_buy_volume_stock', 'desc')
            ->get();

    
        // SELECT  stocks.stock_symbol, 
        //         SUM(sells.volume) AS total_sell_volume_stock
        // FROM sells
        // JOIN stock_prices ON sells.stockp_id = stock_prices.stockp_id
        // JOIN stocks ON stock_prices.stock_symbol = stocks.stock_symbol
        // WHERE sells.port_id = $port->port_id
        // GROUP BY stocks.stock_symbol
        // ORDER BY total_sell_volume_stock DESC;
        $total_sell_stock = DB::table('sells')
            ->join('stock_prices', 'sells.stockp_id', '=', 'stock_prices.stockp_id')
            ->join('stocks', 'stock_prices.stock_symbol', '=', 'stocks.stock_symbol')
            ->where('sells.port_id', $port->port_id)
            ->select('stocks.stock_symbol', DB::raw('SUM(sells.volume) AS total_sell_volume_stock'))
            ->groupBy('stocks.stock_symbol')
            ->orderBy('total_sell_volume_stock', 'desc')
            ->get();


        // SELECT  stocks.stock_symbol, 
        //         AVG(stock_prices.stockp_close) AS average_buy_price
        // FROM buys
        // JOIN stock_prices ON buys.stockp_id = stock_prices.stockp_id
        // JOIN stocks ON stock_prices.stock_symbol = stocks.stock_symbol
        // WHERE buys.port_id = $port->port_id
        // GROUP BY stocks.stock_symbol
        // ORDER BY average_buy_price DESC;
        $total_average_buy_price = DB::table('buys')
            ->join('stock_prices', 'buys.stockp_id', '=', 'stock_prices.stockp_id')
            ->join('stocks', 'stock_prices.stock_symbol', '=', 'stocks.stock_symbol')
            ->where('buys.port_id', $port->port_id)
            ->select('stocks.stock_symbol', DB::raw('AVG(stock_prices.stockp_close) AS average_buy_price'))
            ->groupBy('stocks.stock_symbol')
            ->orderBy('average_buy_price', 'desc')
            ->get();


        // SELECT  stocks.stock_symbol, 
        //         SUM(buys.volume) AS total_buy_volume_stock_eachport
        // FROM buys
        // JOIN ports ON buys.port_id = ports.port_id
        // JOIN stock_prices ON buys.stockp_id = stock_prices.stockp_id
        // JOIN stocks ON stock_prices.stock_symbol = stocks.stock_symbol
        // WHERE ports.user_id = $port->user_id
        // GROUP BY stocks.stock_symbol
        // ORDER BY total_buy_volume_stock_eachport DESC;     
        $total_buy_volume_stock_eachport = DB::table('buys')
            ->join('ports', 'buys.port_id', '=', 'ports.port_id')
            ->join('stock_prices', 'buys.stockp_id', '=', 'stock_prices.stockp_id')
            ->join('stocks', 'stock_prices.stock_symbol', '=', 'stocks.stock_symbol')
            ->where('ports.user_id', $port->user_id)
            ->select('stocks.stock_symbol', DB::raw('SUM(buys.volume) AS total_buy_volume_stock_eachport'))
            ->groupBy('stocks.stock_symbol')
            ->orderBy('total_buy_volume_stock_eachport', 'desc')
            ->get();

        
        // SELECT  stocks.stock_symbol, 
        //         SUM(sells.volume) AS total_sell_volume_stock_eachport
        // FROM sells
        // JOIN ports ON sells.port_id = ports.port_id
        // JOIN stock_prices ON sells.stockp_id = stock_prices.stockp_id
        // JOIN stocks ON stock_prices.stock_symbol = stocks.stock_symbol
        // WHERE ports.user_id = $port->user_id
        // GROUP BY stocks.stock_symbol
        // ORDER BY total_sell_volume_stock_eachport DESC;
        $total_sell_volume_stock_eachport = DB::table('sells')
            ->join('ports', 'sells.port_id', '=', 'ports.port_id')
            ->join('stock_prices', 'sells.stockp_id', '=', 'stock_prices.stockp_id')
            ->join('stocks', 'stock_prices.stock_symbol', '=', 'stocks.stock_symbol')
            ->where('ports.user_id', $port->user_id)
            ->select('stocks.stock_symbol', DB::raw('SUM(sells.volume) AS total_sell_volume_stock_eachport'))
            ->groupBy('stocks.stock_symbol')
            ->orderBy('total_sell_volume_stock_eachport', 'desc')
            ->get();

        $remaining_volume_eachstock = [];
        foreach ($total_buy_stock as $buy_item) {
            $stock = $buy_item->stock_symbol;
            $buy_volume = $buy_item->total_buy_volume_stock;

            $sell_item = $total_sell_stock->where('stock_symbol', $stock)->first();
            $sell_volume = $sell_item ? $sell_item->total_sell_volume_stock : 0;

            $remaining_volume = $buy_volume - $sell_volume;

            // SELECT * FROM stocks
            // WHERE stock_symbol = '$stock'
            // LIMIT 1;
            $stockitem = DB::table('stocks')->where('stock_symbol', $stock)->first();
            $stockP = $stockitem->stock_current_price;

            $avgitem = $total_average_buy_price->where('stock_symbol', $stock)->first();
            $avgprice = $avgitem ? $avgitem->average_buy_price : 0;

            $buy_item_eachport = $total_buy_volume_stock_eachport->where('stock_symbol', $stock)->first();
            $buy_volume_eachport = $buy_item_eachport ? $buy_item_eachport->total_buy_volume_stock_eachport : 0;
            $sell_item_eachport = $total_sell_volume_stock_eachport->where('stock_symbol', $stock)->first();
            $sell_volume_eachport = $sell_item_eachport ? $sell_item_eachport->total_sell_volume_stock_eachport : 0;

            $remaining_volume_stock_eachport = $buy_volume_eachport - $sell_volume_eachport;

            $remaining_volume_eachstock[] = [
                'symbol' => $buy_item->stock_symbol,
                'remaining_volume' => $remaining_volume,
                'currentPrice' =>  $stockP,
                'avg' => $avgprice,
                'remaining_volume_eachport' => $remaining_volume_stock_eachport,
            ];
        }



        return view('real_pages/user_portfolio', [
            'volume_eachport' => $remaining_volume_eachport,
            'volume_account' => $remaining_volume_account,
            'percen' => $percentage,
            'volume_eachstock' => $remaining_volume_eachstock,
        ], compact('port', 'user'));
    }

    public function history(Request $request)
    {
        $port = $request->session()->get('port');
        $user = $request->session()->get('user');
    
        // SELECT  buys.volume AS quantity,
        //         stock_prices.stock_symbol,
        //         stock_prices.stockp_close AS price,
        //         buys.created_at AS date,
        //         'buy' AS type
        // FROM buys
        // JOIN stock_prices ON buys.stockp_id = stock_prices.stockp_id
        // WHERE buys.port_id = $port->port_id;
        $buy_stock = DB::table('buys')
            ->join('stock_prices', 'buys.stockp_id', '=', 'stock_prices.stockp_id')
            ->select('buys.volume as quantity', 'stock_prices.stock_symbol', 'stock_prices.stockp_close as price', 'buys.created_at as date', DB::raw('"buy" as type'))
            ->where('buys.port_id', $port->port_id);
    

        // SELECT  sells.volume AS quantity,
        //         stock_prices.stock_symbol,
        //         stock_prices.stockp_close AS price,
        //         sells.created_at AS date,
        //         'sell' AS type
        // FROM sells
        // JOIN stock_prices ON sells.stockp_id = stock_prices.stockp_id
        // WHERE sells.port_id = $port->port_id;
        $sell_stock = DB::table('sells')
            ->join('stock_prices', 'sells.stockp_id', '=', 'stock_prices.stockp_id')
            ->select( 'sells.volume as quantity', 'stock_prices.stock_symbol', 'stock_prices.stockp_close as price', 'sells.created_at as date', DB::raw('"sell" as type'))
            ->where('sells.port_id', $port->port_id);
    
            // (
            //     SELECT buys.volume AS quantity,
            //            stock_prices.stock_symbol,
            //            stock_prices.stockp_close AS price,
            //            buys.created_at AS date,
            //            'buy' AS type
            //     FROM buys
            //     JOIN stock_prices ON buys.stockp_id = stock_prices.stockp_id
            //     WHERE buys.port_id = $port->port_id
                
            //     UNION
                
            //     SELECT sells.volume AS quantity,
            //            stock_prices.stock_symbol,
            //            stock_prices.stockp_close AS price,
            //            sells.created_at AS date,
            //            'sell' AS type
            //     FROM sells
            //     JOIN stock_prices ON sells.stockp_id = stock_prices.stockp_id
            //     WHERE sells.port_id = $port->port_id
            // )
            // ORDER BY date DESC;
        $history = $buy_stock->union($sell_stock)
            ->orderBy('date', 'desc')
            ->get();
    
        return view('real_pages/user_history', [
            'user' => $request->user(),
            'history' => $history,
        ]);
    }
    

    public function showstock(Request $request)
    {
        $port = $request->session()->get('port');
        $user = $request->session()->get('user');
        // ถ้าพอร์ตไม่มีค่าหรือไม่มี broker_id ให้กลับไปยังหน้าเดิม
        if (!$port || !$port->broker_id) {
            return redirect()->back()->with('error', 'Invalid port data');
        }


        // SELECT * FROM view_stocks
        // JOIN stocks ON view_stocks.stock_symbol = stocks.stock_symbol
        // WHERE view_stocks.broker_id = $port->broker_id;        
        $stocks = DB::table('view_stocks')
            ->where('broker_id', $port->broker_id)
            ->join('stocks', 'view_stocks.stock_symbol', '=', 'stocks.stock_symbol')
            ->get();

        return view('real_pages.user_stock', compact('port', 'user', 'stocks'));
    }

    public function showspecificstock(Request $request, $stock_symbol)
    {
        
        $stock = DB::table('stocks')->where('stock_symbol', $stock_symbol)->first();
        $port = $request->session()->get('port');
        $user = $request->session()->get('user');
        $broker = DB::table('brokers')->where('broker_id', $port->broker_id)->first();
        $sector = DB::table('sectors')->where('sector_id', $stock->sector_id)->first();

        // ตรวจสอบว่าพบหุ้นหรือไม่
        if ($stock) {
            // ส่งข้อมูลหุ้นไปยังหน้าแสดงผล
            return view('real_pages.user_specific_stock', compact('port', 'user', 'stock', 'broker', 'sector'));
        } else {
            // หากไม่พบหุ้นให้ส่งคืน response 404
            abort(404);
        }
    }

    public function prebuy(Request $request, $stock_symbol)
    {
        // รับ stock id จาก request
        $stock = DB::table('stocks')->where('stock_symbol', $stock_symbol)->first();
        $port = $request->session()->get('port');
        $user = $request->session()->get('user');
        $broker = DB::table('brokers')->where('broker_id', $port->broker_id)->first();
        $sector = DB::table('sectors')->where('sector_id', $stock->sector_id)->first();

        // ตรวจสอบว่าพบหุ้นหรือไม่
        if ($stock) {
            // ส่งข้อมูลหุ้นไปยังหน้าแสดงผล
            return view('real_pages.user_prebuy', compact('port', 'user', 'stock', 'broker', 'sector'));
        } else {
            // หากไม่พบหุ้นให้ส่งคืน response 404
            abort(404);
        }
    }

    public function buy(Request $request, $stock_symbol)
    {
        // รับข้อมูลจาก session
        $port = $request->session()->get('port');
        $volume = $request->volume;
        $user = $request->session()->get('user');
        $stock = DB::table('stocks')->where('stock_symbol', $stock_symbol)->first();
        $broker = DB::table('brokers')->where('broker_id', $port->broker_id)->first();
        $sector = DB::table('sectors')->where('sector_id', $stock->sector_id)->first();

        // SELECT stockp_id
        // FROM stock_prices
        // WHERE stock_symbol = $stock_symbol
        // ORDER BY updated_at DESC
        // LIMIT 1;        
        $latest_stock_price_id = DB::table('stock_prices')
            ->where('stock_symbol', $stock_symbol)
            ->orderBy('updated_at', 'desc')
            ->value('stockp_id');

        // ตรวจสอบว่ามีข้อมูลราคาหุ้นล่าสุดหรือไม่
        if ($latest_stock_price_id) {
            // หายอดเงินคงเหลือในพอร์ต

            // SELECT balance
            // FROM ports
            // WHERE port_id = $port->port_id;            
            $balance = DB::table('ports')
                ->where('port_id', $port->port_id)
                ->value('balance');

            // หาราคาหุ้นล่าสุด

            // SELECT stockp_close
            // FROM stock_prices
            // WHERE stockp_id = $latest_stock_price_id;
            $stockp_close = DB::table('stock_prices')
                ->where('stockp_id', $latest_stock_price_id)
                ->value('stockp_close');

            // คำนวณจำนวนเงินทั้งหมดที่ต้องใช้ซื้อหุ้น
            $total_cost = $volume * $stockp_close;

            // เช็คว่ายอดเงินพอซื้อหุ้นหรือไม่
            if ($balance >= $total_cost) {
                // เพิ่มข้อมูลการซื้อในตาราง buys

                // INSERT INTO buys (port_id, stockp_id, volume, created_at, updated_at)
                // VALUES ($port->port_id, $latest_stock_price_id, $volume, NOW(), NOW());                
                DB::table('buys')->insert([
                    'port_id' => $port->port_id,
                    'stockp_id' => $latest_stock_price_id,
                    'volume' => $volume,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                // ลดยอดเงินคงเหลือในพอร์ต

                // UPDATE ports
                // SET balance = balance - $total_cost
                // WHERE port_id = $port->port_id;                
                DB::table('ports')
                    ->where('port_id', $port->port_id)
                    ->decrement('balance', $total_cost);

                // SELECT balance
                // FROM ports
                // WHERE port_id = $port->port_id;
                $port->balance = DB::table('ports')->where('port_id', $port->port_id)->value('balance');
                // ส่งกลับข้อความหรือ redirect ตามที่คุณต้องการ
                return view('real_pages.user_buy_result', [
                    'success' => true,
                    'stock_symbol' => $stock_symbol,
                    'volume' => $volume
                ], compact('port', 'user', 'stock', 'broker', 'sector'));
            }
        }

        $insufficient_funds = $latest_stock_price_id ? ($balance < $total_cost) : 0;
        // กรณีไม่สำเร็จหรือไม่พบข้อมูลราคาหุ้นล่าสุด
        return view('real_pages.user_buy_result', [
            'success' => false,
            'stock_symbol' => $stock_symbol,
            'volume' => $volume,
            'insufficient_funds' =>  $insufficient_funds,
            'stock_not_found' => (!$latest_stock_price_id)
        ], compact('port', 'user', 'stock', 'broker', 'sector'));
    }

    public function presell(Request $request, $stock_symbol)
    {
        // รับ stock id จาก request
        $stock = DB::table('stocks')->where('stock_symbol', $stock_symbol)->first();
        $port = $request->session()->get('port');
        $user = $request->session()->get('user');
        $broker = DB::table('brokers')->where('broker_id', $port->broker_id)->first();
        $sector = DB::table('sectors')->where('sector_id', $stock->sector_id)->first();

        // ตรวจสอบว่าพบหุ้นหรือไม่
        if ($stock) {
            // ส่งข้อมูลหุ้นไปยังหน้าแสดงผล
            return view('real_pages.user_presell', compact('port', 'user', 'stock', 'broker', 'sector'));
        } else {
            // หากไม่พบหุ้นให้ส่งคืน response 404
            abort(404);
        }
    }

    public function sell(Request $request, $stock_symbol)
    {
        // รับข้อมูลจาก session
        $port = $request->session()->get('port');
        $volume = $request->volume;
        $user = $request->session()->get('user');
        $stock = DB::table('stocks')->where('stock_symbol', $stock_symbol)->first();
        $broker = DB::table('brokers')->where('broker_id', $port->broker_id)->first();
        $sector = DB::table('sectors')->where('sector_id', $stock->sector_id)->first();


        // หา ID ของหุ้นล่าสุดจากตาราง stock_prices โดยใช้ stock_symbol

        // SELECT stockp_id
        // FROM stock_prices
        // WHERE stock_symbol = $stock_symbol
        // ORDER BY updated_at DESC
        // LIMIT 1;        
        $latest_stock_price_id = DB::table('stock_prices')
            ->where('stock_symbol', $stock_symbol)
            ->orderBy('updated_at', 'desc')
            ->value('stockp_id');

        // ตรวจสอบว่ามีข้อมูลราคาหุ้นล่าสุดหรือไม่
        if ($latest_stock_price_id) {
            // หายอดเงินคงเหลือในพอร์ต

            // SELECT balance
            // FROM ports
            // WHERE port_id = $port->port_id;            
            $balance = DB::table('ports')
                ->where('port_id', $port->port_id)
                ->value('balance');

            // หาราคาหุ้นล่าสุด

            // SELECT stockp_close
            // FROM stock_prices
            // WHERE stockp_id = $latest_stock_price_id;            
            $stockp_close = DB::table('stock_prices')
                ->where('stockp_id', $latest_stock_price_id)
                ->value('stockp_close');

            // คำนวณจำนวนเงินทั้งหมดที่ต้องได้จากการขายหุ้น
            $total_cost = $volume * $stockp_close;

            // หาจำนวนหุ้นที่ถูกซื้อของหุ้นนั้นๆ

            // SELECT SUM(buys.volume)
            // FROM buys
            // JOIN stock_prices ON buys.stockp_id = stock_prices.stockp_id
            // WHERE buys.port_id = $port->port_id
            // AND stock_prices.stock_symbol = '$stock_symbol';            
            $total_buy_volume = DB::table('buys')
                ->join('stock_prices', 'buys.stockp_id', '=', 'stock_prices.stockp_id')
                ->where('buys.port_id', $port->port_id)
                ->where('stock_prices.stock_symbol', $stock_symbol)
                ->sum('buys.volume');

            // หาจำนวนหุ้นที่ขายของหุ้นนั้นๆ

            // SELECT SUM(sells.volume)
            // FROM sells
            // JOIN stock_prices ON sells.stockp_id = stock_prices.stockp_id
            // WHERE sells.port_id = $port->port_id
            // AND stock_prices.stock_symbol = '$stock_symbol';            
            $total_sell_volume = DB::table('sells')
                ->join('stock_prices', 'sells.stockp_id', '=', 'stock_prices.stockp_id')
                ->where('sells.port_id', $port->port_id)
                ->where('stock_prices.stock_symbol', $stock_symbol)
                ->sum('sells.volume');

            // คำนวณจำนวนหุ้นที่เหลือสำหรับหุ้นนั้นๆ
            $total_remaining_volume = $total_buy_volume - $total_sell_volume;

            // เช็คว่ายอดหุ้นพอขายหรือไม่
            if ($volume <= $total_remaining_volume) {
                // เพิ่มข้อมูลการขายในตาราง buys

                // INSERT INTO sells (port_id, stockp_id, volume, created_at, updated_at)
                // VALUES ($port->port_id, $latest_stock_price_id, $volume, NOW(), NOW());
                DB::table('sells')->insert([
                    'port_id' => $port->port_id,
                    'stockp_id' => $latest_stock_price_id,
                    'volume' => $volume,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                // เพิ่มยอดเงินคงเหลือในพอร์ต

                // UPDATE ports
                // SET balance = balance + $total_cost
                // WHERE port_id = $port->port_id;
                DB::table('ports')
                    ->where('port_id', $port->port_id)
                    ->increment('balance', $total_cost);
                
                // SELECT balance
                // FROM ports
                // WHERE port_id = $port->port_id;                    
                $port->balance = DB::table('ports')->where('port_id', $port->port_id)->value('balance');

                // ส่งกลับข้อความหรือ redirect ตามที่คุณต้องการ
                return view('real_pages.user_sell_result', [
                    'success' => true,
                    'stock_symbol' => $stock_symbol,
                    'volume' => $volume
                ], compact('port', 'user', 'stock', 'broker', 'sector'));
            }
        }

        $insufficient_funds = $latest_stock_price_id > 0 ? ($volume > $total_remaining_volume) : 0;
        // กรณีไม่สำเร็จหรือไม่พบข้อมูลราคาหุ้นล่าสุด
        return view('real_pages.user_sell_result', [
            'success' => false,
            'stock_symbol' => $stock_symbol,
            'volume' => $volume,
            'insufficient_funds' =>  $insufficient_funds,
            'stock_not_found' => (!$latest_stock_price_id)
        ], compact('port', 'user', 'stock', 'broker', 'sector'));
    }

    public function showwallet(Request $request) {
        $port = $request->session()->get('port');
        $user = $request->session()->get('user');
        $balance = $port->balance;
        return view('real_pages/user_wallet_main', compact('port', 'user','balance'));
    }

}
