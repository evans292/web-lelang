<?php

namespace App\Http\Controllers\Masyarakat;

use App\Models\Bid;
use App\Models\Item;
use App\Models\Auction;
use Illuminate\Http\Request;
use App\Events\FormSubmitted;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Broadcasting\BroadcastException;

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

            $peopleName = Auth::user()->people[0]->name;
            
            $bidPrice = number_format($request->bid, 0, ',', '.');

        try {
            event(new FormSubmitted("$peopleName telah menawar $request->item_name dengan harga Rp. $bidPrice"));
        } catch (BroadcastException $e) {
            //throw $th;
            echo 'Message: ' .$e->getMessage();
        }

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
    public function edit(Auction $auction, Item $item, Bid $bid)
    {
        //
        if (Gate::allows('admin') || Gate::allows('petugas')) {
            abort(403);
        }

        return view('masyarakat.edit-bid', compact('auction', 'item', 'bid'));
    }

    public function updateBid(Request $request, Auction $auction, Item $item, Bid $bid)
    {
        if (Gate::allows('admin') || Gate::allows('petugas')) {
            abort(403);
        }

        if($request->bid >= $item->starting_price) {
            $request->validate([
                'bid' => 'required'
            ]);

        $bid->bid_price = $request->bid;
        $bid->save();

        $peopleName = Auth::user()->people[0]->name;
        $bidPrice = number_format($request->bid, 0, ',', '.');
            
        try {
            event(new FormSubmitted("$peopleName telah memperbarui tawaran untuk $item->name dengan harga Rp. $bidPrice"));
        } catch (BroadcastException $e) {
            //throw $th;
            echo 'Message: ' .$e->getMessage();
        }

            return redirect()->back()->with('success', 'lol');
        } else {
            return redirect()->back()->with('fail', 'lol');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bid  $bid
     * @return \Illuminate\Http\Response
     */
    public function updateAuction(Request $request, Bid $bid)
    {
        //
        if (Gate::allows('admin') || Gate::allows('masyarakat')) {
            abort(403);
        }

        $auc = Auction::where('item_id', $bid->item_id)->first();

        $auc->update([
            'bid_id' => $bid->id,
            'final_price' => $bid->bid_price,
            'status' => 'close'
        ]);
        
        $itemName = $bid->item->name;
        $winnerName = $bid->people->name;

        try {
        event(new FormSubmitted("$winnerName telah memenangkan lelang $itemName"));
        } catch (BroadcastException $e) {
            //throw $th;
            echo 'Message: ' .$e->getMessage();
        }
        return redirect()->back()->with('success', 'lol');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bid  $bid
     * @return \Illuminate\Http\Response
     */
    public function destroy(Auction $auction, Item $item, Bid $bid)
    {
        //
        if (Gate::allows('admin') || Gate::allows('petugas')) {
            abort(403);
        }

        $bid->delete();

        $itemName = $bid->item->name;
        $peopleName = $bid->people->name;

        try {
            event(new FormSubmitted("$peopleName telah keluar dari lelang $itemName"));
            } catch (BroadcastException $e) {
                //throw $th;
                echo 'Message: ' .$e->getMessage();
            }

        return redirect()->back()->with('delete', 'lol');
    }
}
