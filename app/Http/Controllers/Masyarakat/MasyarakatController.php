<?php

namespace App\Http\Controllers\Masyarakat;

use App\Models\Auction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MasyarakatController extends Controller
{
    //
    public function dashboard()
    {
        $auc = Auction::where('status', 'open')->latest()->first();
        $auction = Auction::paginate(10);

        return view('dashboard', compact('auc', 'auction'));
    }

    public function index()
    {
        return view('masyarakat.index');
    }
}
