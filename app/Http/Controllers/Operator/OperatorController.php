<?php

namespace App\Http\Controllers\Operator;

use App\Models\Item;
use App\Models\User;
use App\Models\People;
use App\Models\Operator;
use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use App\Http\Controllers\Controller;
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

        return view('operator.index');
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

    public function showItem()
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
}
