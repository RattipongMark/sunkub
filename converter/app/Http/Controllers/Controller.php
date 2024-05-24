<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Convert a Laravel query builder instance to its raw SQL.
     *
     * @param \Illuminate\Database\Query\Builder $query
     * @return string
     */
    public function toRawSql($query)
    {
        $sql = str_replace(['%', '?'], ['%%', '%s'], $query->toSql());
        return vsprintf($sql, $query->getBindings());
    }

    public function index()
    {

        $query = DB::table('buys')
        ->join('stock_prices', 'buys.stockp_id', '=', 'stock_prices.stockp_id')
        ->where('buys.port_id', '$port->port_id')
        ->sum(DB::raw('buys.volume * stock_prices.stockp_close'));

        $rawSql = $this->toRawSql($query);
        dd($rawSql);
    }
}
