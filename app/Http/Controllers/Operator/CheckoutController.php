<?php

namespace App\Http\Controllers\Operator;

use App\Models\Item;
use App\Models\Auction;
use App\Models\Checkout;
use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Psy\VersionUpdater\Checker;

class CheckoutController extends Controller
{
    //
    public function index(Auction $auction, Item $item)
    {
        if (Gate::allows('petugas') || Gate::allows('admin')) {
            abort(403);
        }

        return view('masyarakat.checkout-index', compact('auction', 'item'));
    }
    
    public function list()
    {
        if (Gate::allows('masyarakat') || Gate::allows('admin')) {
            abort(403);
        }

        $datas = Checkout::paginate(10);
        return view('operator.petugas.checkout.index', compact('datas'));
    }

    public function showList(Checkout $checkout)
    {
        return view('operator.petugas.checkout.show', compact('checkout'));
    }

    public function create(Auction $auction, Item $item)
    {
        if (Gate::allows('petugas') || Gate::allows('admin')) {
            abort(403);
        }
        $kurirs = ['JNE', 'TIKI', 'J&T', 'siCepat', 'idExpress'];
        return view('masyarakat.checkout-create', compact('auction', 'item', 'kurirs'));
    }

    public function store(Request $request)
    {
        if (Gate::allows('petugas') || Gate::allows('admin')) {
            abort(403);
        }

        $request->validate([
            'address' => 'required',
            'kurir' => 'required'
        ]);

        $checkout = Checkout::create([
            'item_id' => $request->item_id,
            'people_id' => Auth::user()->people[0]->id,
            'address' => $request->address,
            'kurir' => $request->kurir
        ]);

        $temporaryfile = TemporaryFile::where('folder', $request->pic)->first();
        if ($temporaryfile) {
            $checkout->addMedia(storage_path('app/public/image/tmp/' . $request->pic . '/' . $temporaryfile->filename))
            ->toMediaCollection('checkout');
            rmdir(storage_path('app/public/image/tmp/' . $request->pic));
            $temporaryfile->delete();
        }

        return redirect()->route('bid-list.create', ['auction' => $request->auc_id, 'item' => $request->item_id])->with('cek', 'lol');
    }

    public function show(Auction $auction, Item $item)
    {
        if (Gate::allows('petugas') || Gate::allows('admin')) {
            abort(403);
        }
        $checkout = Checkout::where('item_id', $item->id)->first();
        return view('masyarakat.checkout-show', compact('auction', 'item', 'checkout'));
    }

    public function edit(Checkout $checkout) 
    {
        if (Gate::allows('masyarakat') || Gate::allows('admin')) {
            abort(403);
        }

        return view('operator.petugas.checkout.edit', compact('checkout'));
    }

    public function update(Request $request, Checkout $checkout) 
    {
        if (Gate::allows('masyarakat') || Gate::allows('admin')) {
            abort(403);
        }

        $request->validate([
            'resi' => 'required|max:15'
        ]);

        $checkout->update([
            'operator_id' => Auth::user()->operators[0]->id,
            'receipt' => $request->resi,
            'status' => 'dikirim',
            'receipt_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->back()->with('success', 'lol');
    }

    public function done(Request $request, Auction $auction, Item $item)
    {
        if (Gate::allows('petugas') || Gate::allows('admin')) {
            abort(403);
        }
        $checkout = Checkout::where('item_id', $item->id)->first();

        $checkout->update([
            'status' => 'selesai',
            'done_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->back()->with('success', 'lol');
    }
}
