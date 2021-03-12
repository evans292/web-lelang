<?php

namespace App\Http\Controllers\Operator;

use App\Models\Item;
use App\Models\User;
use App\Models\People;
use App\Models\Operator;
use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use App\Http\Controllers\Controller;
use App\Models\Auction;
use App\Models\Bid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Spatie\MediaLibrary\MediaCollections\Exceptions\DiskDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;

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

    public function showOperators()
    {
        if (Gate::allows('masyarakat') || Gate::allows('petugas')) {
            abort(403);
        }

        $datas = Operator::paginate(10);

        return view('operator.admin.operator.index', compact('datas'));
    }

    public function showOperator(Operator $operator)
    {
        if (Gate::allows('masyarakat') || Gate::allows('petugas')) {
            abort(403);
        }

        return view('operator.admin.operator.show', compact('operator'));
    }

    public function registerOperator()
    {
        if (Gate::allows('masyarakat') || Gate::allows('petugas')) {
            abort(403);
        }

        $roles = [1 => 'Administrator', 2 => 'Petugas'];

        return view('operator.admin.operator.create', compact('roles'));
    }

    public function storeOperator(Request $request)
    {
        if (Gate::allows('masyarakat') || Gate::allows('petugas')) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'role' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role
        ]);

        Operator::create([
            'user_id' => $user->id,
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'lol');
    }

    public function editOperator(User $user)
    {
        if (Gate::allows('masyarakat') || Gate::allows('petugas')) {
            abort(403);
        }

        $roles = [1 => 'Administrator', 2 => 'Petugas'];

        return view('operator.admin.operator.edit', compact('roles', 'user'));
    }

    public function updateOperator(Request $request, User $user)
    {
        $user->role_id = $request->role;
        $user->save();

        return redirect()->back()->with('success', 'lol');
    }

    public function destroy(User $user)
    {
        if (Gate::allows('masyarakat') || Gate::allows('petugas')) {
            abort(403);
        }

        $user->delete();

        return redirect()->back()->with('success', 'lol');
    }

    public function showPeoples()
    {
        if (Gate::allows('masyarakat') || Gate::allows('petugas')) {
            abort(403);
        }

        $datas = People::paginate(10);
        return view('operator.admin.people.index', compact('datas'));
    }

    public function showPeople(People $people)
    {
        if (Gate::allows('masyarakat') || Gate::allows('petugas')) {
            abort(403);
        }

        return view('operator.admin.people.show', compact('people'));
    }

    public function showItems()
    {
        if (Gate::allows('masyarakat')) {
            abort(403);
        }

        $datas = Item::paginate(10);

        return view('operator.both.item.index', compact('datas'));
    }

    public function registerItem()
    {
        if (Gate::allows('masyarakat')) {
            abort(403);
        }

        return view('operator.both.item.create');
    }

    public function storeItem(Request $request)
    {
        if (Gate::allows('masyarakat')) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'price' => 'required',
            'desc' => 'required|string'
        ]);

        $item = Item::create([
            'name' => $request->name,
            'date' => $request->date,
            'starting_price' => $request->price,
            'desc' => $request->desc,
            'operator_id' => Auth::user()->operators[0]->id
        ]);

        
            $images = $request->pics;

            foreach($images as $key => $image) {
                $temporaryfile = TemporaryFile::where('folder', $image)->first();
                if ($temporaryfile) {
                    
                    try {
                        $item->addMedia(storage_path('app/public/image/tmp/' . $image . '/' . $temporaryfile->filename))->toMediaCollection('item');
                    } catch (DiskDoesNotExist $e) {
                    } catch (FileDoesNotExist $e) {
                    } catch (FileIsTooBig $e) {
                    }

                    rmdir(storage_path('app/public/image/tmp/' . $image));
                    $temporaryfile->delete();
                }
            }

         return redirect()->back()->with('success', 'lol');
    }

    public function showItem(Item $item)
    {
        if (Gate::allows('masyarakat')) {
            abort(403);
        }

        return view('operator.both.item.show', compact('item'));
    }

    public function editItem(Item $item)
    {
        if (Gate::allows('masyarakat')) {
            abort(403);
        }

        return view('operator.both.item.edit', compact('item'));
    }

    public function destroyItem(Item $item)
    {
        if (Gate::allows('masyarakat')) {
            abort(403);
        }

        $item->delete();

        return redirect()->back()->with('success', 'lol');
    }

    public function updateItem(Request $request, Item $item)
    {
        if (Gate::allows('masyarakat')) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'price' => 'required',
            'desc' => 'required|string'
        ]);

        $item->update([
            'name' => $request->name,
            'date' => $request->date,
            'starting_price' => $request->price,
            'desc' => $request->desc,
            'operator_id' => Auth::user()->operators[0]->id
        ]);

        
            $images = $request->pics;

            if ($images) {


                if ($item->hasMedia('item')) {
                    # code...
                    $item->media()->delete($item->id);
                    foreach($images as $key => $image) {
                        $temporaryfile = TemporaryFile::where('folder', $image)->first();
                        if ($temporaryfile) {
                            
                            try {
                                $item->addMedia(storage_path('app/public/image/tmp/' . $image . '/' . $temporaryfile->filename))->toMediaCollection('item');
                            } catch (DiskDoesNotExist $e) {
                            } catch (FileDoesNotExist $e) {
                            } catch (FileIsTooBig $e) {
                            }
        
                            rmdir(storage_path('app/public/image/tmp/' . $image));
                            $temporaryfile->delete();
                        }
                    }
                }
            }

         return redirect()->back()->with('success', 'lol');
    }

    public function showAuctions()
    {
        if (Gate::allows('masyarakat') || Gate::allows('admin')) {
            abort(403);
        }

        $datas = Auction::paginate(10);

        return view('operator.petugas.auction.index', compact('datas'));
    }

    public function registerAuction() 
    {
        if (Gate::allows('masyarakat') || Gate::allows('admin')) {
            abort(403);
        }

        $datas = Item::all();

        return view('operator.petugas.auction.create', compact('datas'));
    }

    public function storeAuction(Request $request)
    {
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

        return redirect()->back()->with('success', 'lol');
    }

    public function editAuction(Auction $auction) 
    {
        if (Gate::allows('masyarakat') || Gate::allows('admin')) {
            abort(403);
        }

        $datas = Item::all();

        return view('operator.petugas.auction.edit', compact('datas', 'auction'));
    }

    public function updateAuction(Request $request, Auction $auction)
    {
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

    public function showAuction(Auction $auction)
    {
        if (Gate::allows('masyarakat') || Gate::allows('admin')) {
            abort(403);
        }

        
    }

    public function destroyAuction(Auction $auction)
    {
        if (Gate::allows('masyarakat') || Gate::allows('admin')) {
            abort(403);
        }

        $auction->delete();

        return redirect()->back()->with('success', 'lol');
    }
}
