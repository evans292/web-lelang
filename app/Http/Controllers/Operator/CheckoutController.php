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

class CheckoutController extends Controller
{
    //
    public function list()
    {
        if (Gate::allows('masyarakat') || Gate::allows('admin')) {
            abort(403);
        }

        $datas = Checkout::paginate(10);
        return view('operator.petugas.checkout.index', compact('datas'));
    }

    public function index(Auction $auction, Item $item)
    {
        if (Gate::allows('petugas') || Gate::allows('admin')) {
            abort(403);
        }

        return view('masyarakat.checkout-index', compact('auction', 'item'));
    }

    public function create(Auction $auction, Item $item)
    {
        if (Gate::allows('petugas') || Gate::allows('admin')) {
            abort(403);
        }

        return view('masyarakat.checkout-create', compact('auction', 'item'));
    }

    public function store(Request $request)
    {
        if (Gate::allows('petugas') || Gate::allows('admin')) {
            abort(403);
        }

        $request->validate([
            'address' => 'required'
        ]);

        $checkout = Checkout::create([
            'item_id' => $request->item_id,
            'people_id' => Auth::user()->people[0]->id,
            'address' => $request->address,
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

}
