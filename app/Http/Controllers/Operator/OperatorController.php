<?php

namespace App\Http\Controllers\Operator;

use App\Models\{Item, Operator, Auction, Bid};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class OperatorController extends Controller
{
    //
    public function index()
    {
        if (Gate::allows('masyarakat')) {
            abort(403);
        }

        $count_op = Operator::all()->count();
        $count_it = Item::all()->count();
        $count_au = Auction::all()->count();
        $count_bi = Bid::all()->count();

        return view('operator.index', compact('count_op', 'count_it', 'count_au', 'count_bi'));
    }
}
