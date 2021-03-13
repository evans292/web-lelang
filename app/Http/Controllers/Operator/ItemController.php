<?php

namespace App\Http\Controllers\Operator;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Spatie\MediaLibrary\MediaCollections\Exceptions\DiskDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Gate::allows('masyarakat')) {
            abort(403);
        }

        $datas = Item::paginate(10);

        return view('operator.both.item.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if (Gate::allows('masyarakat')) {
            abort(403);
        }

        return view('operator.both.item.create');
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
        if (Gate::allows('masyarakat')) {
            abort(403);
        }

        return view('operator.both.item.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
        if (Gate::allows('masyarakat')) {
            abort(403);
        }

        return view('operator.both.item.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
        if (Gate::allows('masyarakat')) {
            abort(403);
        }

        $item->delete();

        return redirect()->back()->with('success', 'lol');
    }
}
