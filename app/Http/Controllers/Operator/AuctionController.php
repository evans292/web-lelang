<?php

namespace App\Http\Controllers\Operator;

use App\Models\Item;
use App\Models\Auction;
use Illuminate\Http\Request;
use App\Events\FormSubmitted;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuctionController extends Controller
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

        $datas = Auction::where('status', 'open')->paginate(10);

        return view('operator.petugas.auction.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if (Gate::allows('masyarakat') || Gate::allows('admin')) {
            abort(403);
        }

        $datas = Item::all();

        return view('operator.petugas.auction.create', compact('datas'));
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
        if (Gate::allows('masyarakat') || Gate::allows('admin')) {
            abort(403);
        }

        $request->validate([
            'item_id' => 'required|unique:auctions',
            'date' => 'required|date'
        ]);

        Auction::create([
            'item_id' => $request->item_id,
            'auction_date' => $request->date,
            'operator_id' => Auth::user()->operators[0]->id
        ]);

        $operatorName = Auth::user()->operators[0]->name;

        event(new FormSubmitted("$operatorName telah menambah lelang baru"));

        return redirect()->back()->with('success', 'lol');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Auction  $auction
     * @return \Illuminate\Http\Response
     */
    public function show(Auction $auction)
    {
        //
        if (Gate::allows('masyarakat') || Gate::allows('admin')) {
            abort(403);
        }

        return view('operator.petugas.auction.show', compact('auction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Auction  $auction
     * @return \Illuminate\Http\Response
     */
    public function edit(Auction $auction)
    {
        //
        if (Gate::allows('masyarakat') || Gate::allows('admin')) {
            abort(403);
        }

        $datas = Item::all();

        return view('operator.petugas.auction.edit', compact('datas', 'auction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Auction  $auction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Auction $auction)
    {
        //
        if (Gate::allows('masyarakat') || Gate::allows('admin')) {
            abort(403);
        }

        $request->validate([
            'item_id' => 'required|unique:auctions,item_id,' . $auction->id,
            'date' => 'required|date'
        ]);

        $auction->update([
            'item_id' => $request->item_id,
            'auction_date' => $request->date,
            'operator_id' => Auth::user()->operators[0]->id
        ]);

        return redirect()->back()->with('success', 'lol');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Auction  $auction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Auction $auction)
    {
        //
        if (Gate::allows('masyarakat') || Gate::allows('admin')) {
            abort(403);
        }

        $auction->delete();

        return redirect()->back()->with('success', 'lol');
    }

    public function history()
    {
        if (Gate::allows('masyarakat')) {
            abort(403);
        }

        $datas = Auction::where('status', 'close')->paginate(10);

        return view('operator.petugas.auction.index', compact('datas')); 
    }
}
