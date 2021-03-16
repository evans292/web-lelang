<?php

namespace App\Http\Controllers\Masyarakat;

use App\Models\Bid;
use App\Models\Auction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MasyarakatController extends Controller
{
    //
    public function dashboard()
    {
        $auc = Auction::where('status', 'open')->latest()->first();
        $auction = Auction::where('status', 'open')->orderBy('created_at', 'desc')->paginate(10);

        return view('dashboard', compact('auc', 'auction'));
    }

    public function index()
    {
        $bids = Bid::where('people_id', Auth::user()->people[0]->id)->paginate(10);
        $all = Auction::where('status', 'close')->paginate(10);
        return view('masyarakat.index', compact('bids', 'all'));
    }
}
