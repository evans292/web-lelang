<?php

namespace App\Http\Controllers\Masyarakat;

use App\Models\Bid;
use App\Models\Item;
use App\Models\Auction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class BidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Gate::allows('masyarakat') || Gate::allows('admin')) {
            abort(403);
        }

        $datas = Bid::paginate(10);

        return view('operator.petugas.bid.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Auction $auction, Item $item)
    {
        //
        $bid = null;

        if (Auth::user()->role_id === 3) {
            # code...
            $bid = Bid::where('item_id', $item->id)->where('people_id', Auth::user()->people[0]->id)->first();
        }

        return view('masyarakat.place-bid', compact('auction', 'bid'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if (Gate::allows('admin') || Gate::allows('petugas')) {
            abort(403);
        }

        if($request->bid >= $request->starting_price) {
            $request->validate([
                'bid' => 'required'
            ]);
    
            Bid::create([
                'item_id' => $request->item_id,
                'people_id' => Auth::user()->people[0]->id,
                'bid_price' => $request->bid
            ]);
            return redirect()->back()->with('success', 'lol');
        } else {
            return redirect()->back()->with('fail', 'lol');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bid  $bid
     * @return \Illuminate\Http\Response
     */
    public function show(Bid $bid)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bid  $bid
     * @return \Illuminate\Http\Response
     */
    public function edit(Bid $bid)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bid  $bid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bid $bid)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bid  $bid
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bid $bid)
    {
        //
    }
}
